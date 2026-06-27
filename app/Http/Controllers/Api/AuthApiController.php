<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthApiController extends Controller
{
    // POST /api/auth/login
    // Body: { identifier, password }
    // → envoie un OTP par email, retourne un otp_token temporaire
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'identifier' => 'required|string',
            'password'   => 'required|string',
        ]);

        $user = User::where('email', $request->identifier)
                    ->orWhere('phone', $request->identifier)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Identifiants incorrects.'], 401);
        }

        if ($user->type !== 'client') {
            return response()->json(['message' => 'Accès réservé aux clients.'], 403);
        }

        if ($user->is_blocked) {
            return response()->json(['message' => 'Compte bloqué. Contactez le support.'], 403);
        }

        $otp      = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpToken = bin2hex(random_bytes(16));

        Cache::put('api_otp_' . $otpToken, [
            'user_id' => $user->id,
            'otp'     => Hash::make($otp),
        ], 600); // 10 minutes

        try {
            Mail::to($user->email)->send(new OtpMail($otp, $user));
        } catch (\Throwable) {
            return response()->json(['message' => 'Impossible d\'envoyer l\'OTP.'], 500);
        }

        return response()->json([
            'message'   => 'Code OTP envoyé à ' . $user->email,
            'otp_token' => $otpToken,
            'email'     => substr($user->email, 0, 3) . '***@' . explode('@', $user->email)[1],
        ]);
    }

    // POST /api/auth/otp
    // Body: { otp_token, otp }
    // → vérifie l'OTP, retourne le token Sanctum
    public function verifyOtp(Request $request): JsonResponse
    {
        $request->validate([
            'otp_token' => 'required|string',
            'otp'       => 'required|string|size:6',
        ]);

        $cached = Cache::get('api_otp_' . $request->otp_token);

        if (!$cached || !Hash::check($request->otp, $cached['otp'])) {
            return response()->json(['message' => 'Code OTP invalide ou expiré.'], 422);
        }

        $user = User::find($cached['user_id']);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur introuvable.'], 404);
        }

        Cache::forget('api_otp_' . $request->otp_token);

        // Révoquer les anciens tokens mobile pour cet appareil
        $user->tokens()->where('name', 'mobile')->delete();

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => [
                'id'       => $user->id,
                'name'     => $user->name,
                'email'    => $user->email,
                'phone'    => $user->phone,
                'balance'  => (float) $user->balance,
                'currency' => $user->currency ?? 'EUR',
                'locale'   => $user->locale ?? 'fr',
                'avatar'   => strtoupper(substr($user->name, 0, 1)),
            ],
        ]);
    }

    // POST /api/auth/logout
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Déconnecté.']);
    }
}
