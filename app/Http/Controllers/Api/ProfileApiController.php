<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ProfileApiController extends Controller
{
    // GET /api/profile
    public function show(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'id'         => $user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'phone'      => $user->phone,
            'address'    => $user->address,
            'birth_date' => $user->birth_date?->toDateString(),
            'id_type'    => $user->id_type,
            'id_number'  => $user->id_number,
            'balance'    => (float) $user->balance,
            'currency'   => $user->currency ?? 'EUR',
            'locale'     => $user->locale ?? 'fr',
            'avatar'     => strtoupper(substr($user->name, 0, 1)),
        ]);
    }

    // PUT /api/profile
    public function update(Request $request): JsonResponse
    {
        $user      = $request->user();
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'locale'  => 'nullable|in:fr,en,pl,es,bg,hu,el,de,pt,hr,it,lt,mt,sl',
        ]);

        $user->update(array_filter($validated, fn ($v) => !is_null($v)));

        return response()->json([
            'message' => __('api.profile.updated'),
            'user'    => [
                'name'    => $user->name,
                'phone'   => $user->phone,
                'address' => $user->address,
                'locale'  => $user->locale,
            ],
        ]);
    }

    // POST /api/profile/email/request
    public function requestEmailChange(Request $request): JsonResponse
    {
        $user      = $request->user();
        $validated = $request->validate(['email' => 'required|email|max:191']);
        $newEmail  = strtolower(trim($validated['email']));

        if ($newEmail === strtolower($user->email)) {
            return response()->json(['message' => __('api.profile.same_email')], 422);
        }

        $otp      = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpToken = bin2hex(random_bytes(16));

        Cache::put('api_email_otp_' . $user->id, [
            'otp'       => Hash::make($otp),
            'new_email' => $newEmail,
            'token'     => $otpToken,
        ], 600);

        try {
            Mail::to($user->email)->send(new OtpMail($otp, $user));
        } catch (\Throwable) {
            return response()->json(['message' => __('api.profile.otp_send_failed')], 500);
        }

        return response()->json([
            'message'   => __('api.profile.email_otp_sent'),
            'otp_token' => $otpToken,
        ]);
    }

    // POST /api/profile/email/confirm
    public function confirmEmailChange(Request $request): JsonResponse
    {
        $user   = $request->user();
        $cached = Cache::get('api_email_otp_' . $user->id);

        $request->validate([
            'otp_token' => 'required|string',
            'otp'       => 'required|string|size:6',
        ]);

        if (!$cached
            || $cached['token'] !== $request->otp_token
            || !Hash::check($request->otp, $cached['otp'])) {
            return response()->json(['message' => __('api.profile.otp_invalid')], 422);
        }

        $user->update(['email' => $cached['new_email']]);
        Cache::forget('api_email_otp_' . $user->id);

        return response()->json([
            'message' => __('api.profile.email_updated'),
            'email'   => $user->email,
        ]);
    }

    // POST /api/profile/password
    public function changePassword(Request $request): JsonResponse
    {
        $user = $request->user();
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => __('api.profile.wrong_password')], 422);
        }

        $user->update(['password' => Hash::make($request->password)]);

        $user->tokens()->where('name', 'mobile')
            ->where('id', '!=', $request->user()->currentAccessToken()?->id)
            ->delete();

        return response()->json(['message' => __('api.profile.password_updated')]);
    }
}
