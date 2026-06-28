<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\NotificationApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\SupportApiController;
use App\Http\Controllers\Api\TransferApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Mobile — Credixa
| Auth : Bearer token Sanctum (Authorization: Bearer {token})
| Prefix: /api
|--------------------------------------------------------------------------
*/

// ── Authentification (public) ─────────────────────────────────────────────
Route::prefix('auth')->middleware('setLocale')->group(function () {
    Route::post('/login',  [AuthApiController::class, 'login']);      // Étape 1 : identifiant + mdp → OTP email
    Route::post('/otp',    [AuthApiController::class, 'verifyOtp']);  // Étape 2 : OTP → token Sanctum
});

// ── Routes protégées (Bearer token requis) ────────────────────────────────
Route::middleware(['auth:sanctum', 'throttle:120,1', 'setLocale'])->group(function () {

    // Déconnexion
    Route::post('/auth/logout', [AuthApiController::class, 'logout']);

    // Dashboard
    Route::get('/dashboard', [ClientApiController::class, 'dashboard']);

    // Prêts
    Route::get('/loans',      [ClientApiController::class, 'loans']);
    Route::get('/loans/{id}', [ClientApiController::class, 'loanShow']);

    // Mouvements de compte
    Route::get('/movements', [ClientApiController::class, 'movements']);

    // Factures
    Route::get('/invoices', [ClientApiController::class, 'invoices']);

    // Analytiques
    Route::get('/analytics', [ClientApiController::class, 'analytics']);

    // Transferts
    Route::get('/transfers',      [TransferApiController::class, 'index']);
    Route::post('/transfers/send', [TransferApiController::class, 'send']);

    // Notifications
    Route::get('/notifications',              [NotificationApiController::class, 'index']);
    Route::get('/notifications/count',        [NotificationApiController::class, 'count']);
    Route::post('/notifications/read-all',    [NotificationApiController::class, 'readAll']);
    Route::post('/notifications/{id}/read',   [NotificationApiController::class, 'read']);

    // Support chat
    Route::get('/support/messages',  [SupportApiController::class, 'index']);   // ?after=0 pour polling
    Route::post('/support/messages', [SupportApiController::class, 'store']);

    // Profil
    Route::get('/profile',                   [ProfileApiController::class, 'show']);
    Route::put('/profile',                   [ProfileApiController::class, 'update']);
    Route::post('/profile/email/request',    [ProfileApiController::class, 'requestEmailChange']);
    Route::post('/profile/email/confirm',    [ProfileApiController::class, 'confirmEmailChange']);
    Route::post('/profile/password',         [ProfileApiController::class, 'changePassword']);

});

// ── Fallback ──────────────────────────────────────────────────────────────
Route::fallback(fn () => response()->json(['error' => 'Not found.'], 404));
