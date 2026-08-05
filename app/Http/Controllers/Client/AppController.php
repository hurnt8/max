<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\AccountMovement;
use App\Models\ClientNotification;
use App\Models\Invoice;
use App\Models\LoanRequest;
use App\Models\SiteContact;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        // Brouillons non visibles dans le compte client
        $loans = LoanRequest::where('client_id', $user->id)
            ->where('status', '!=', LoanRequest::STATUS_DRAFT)
            ->latest()->get();

        $activeLoans  = $loans->whereIn('status', [
            LoanRequest::STATUS_CONTRACT_SENT,
            LoanRequest::STATUS_CONTRACT_SIGNED,
            LoanRequest::STATUS_FINALIZED,
        ])->values();

        $pendingLoans = $loans->whereIn('status', [
            LoanRequest::STATUS_PENDING,
            LoanRequest::STATUS_VALIDATED,
        ])->values();

        $unreadCount = ClientNotification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->count();

        // 5 dernières transactions (mouvements admin + virements fusionnés)
        $adminMvts = AccountMovement::where('user_id', $user->id)
            ->latest()->limit(10)->get()
            ->map(fn ($m) => (object) [
                'source'    => 'account',
                'type'      => $m->type,
                'amount'    => (float) $m->amount,
                'currency'  => $m->currency,
                'label'     => $m->type === 'credit' ? __('app.mv_credit_label') : __('app.mv_debit_label'),
                'sub'       => $m->note ?? '',
                'status'    => 'completed',
                'created_at'=> $m->created_at,
            ]);

        $recentTransfers = Transfer::where('user_id', $user->id)
            ->whereIn('status', [
                Transfer::STATUS_PENDING,
                Transfer::STATUS_COMPLETED,
                Transfer::STATUS_FEE_REQUIRED,
                Transfer::STATUS_REJECTED,
            ])
            ->latest()->limit(10)->get()
            ->map(fn ($t) => (object) [
                'source'    => 'transfer',
                'type'      => $t->type === 'send' ? 'debit' : 'credit',
                'amount'    => (float) $t->amount,
                'currency'  => $t->currency,
                'label'     => $t->type === 'send'
                    ? __('app.mv_transfer_sent') . ' ' . $t->beneficiary_name
                    : __('app.mv_transfer_received'),
                'sub'       => $t->reference,
                'status'    => $t->status,
                'created_at'=> $t->created_at,
            ]);

        $recentActivity = $adminMvts->merge($recentTransfers)
            ->sortByDesc('created_at')
            ->take(5)
            ->values();

        return view('client.app.home', compact(
            'user', 'loans', 'activeLoans', 'pendingLoans', 'recentActivity', 'unreadCount'
        ));
    }

    public function loans()
    {
        $user  = Auth::user();
        // Les brouillons ne sont pas visibles dans l'espace client
        $loans = LoanRequest::where('client_id', $user->id)
            ->where('status', '!=', LoanRequest::STATUS_DRAFT)
            ->latest()->get();

        return view('client.app.loans.index', compact('user', 'loans'));
    }

    public function invoices()
    {
        $user     = Auth::user();
        $invoices = Invoice::where('client_id', $user->id)
            ->whereIn('status', [Invoice::STATUS_SENT, Invoice::STATUS_PAID, Invoice::STATUS_CANCELLED])
            ->latest()
            ->get();

        return view('client.app.invoices.index', compact('user', 'invoices'));
    }

    public function invoiceShow(Invoice $invoice)
    {
        $user = Auth::user();
        abort_if($invoice->client_id !== $user->id, 403);

        return view('client.app.invoices.show', compact('user', 'invoice'));
    }

    public function loanShow(LoanRequest $loan)
    {
        $user = Auth::user();
        abort_unless($loan->client_id === $user->id, 403);

        $loan->load(['admin']);

        $principal = (float) $loan->amount;
        $total     = (float) $loan->total_with_interest;
        $interest  = max(0, $total - $principal);

        return view('client.app.loans.show', compact('user', 'loan', 'principal', 'interest', 'total'));
    }

    public function analytics()
    {
        $user  = Auth::user();
        // Les dossiers rejetés ne sont pas comptabilisés dans les analytiques
        $loans = LoanRequest::where('client_id', $user->id)
            ->where('status', '!=', LoanRequest::STATUS_REJECTED)
            ->whereNotNull('amortization_schedule')
            ->get();

        $monthlyData = [];
        foreach ($loans as $loan) {
            $schedule = $loan->amortization_schedule ?? [];
            foreach ($schedule as $row) {
                $key = 'M' . $row['month'];
                $monthlyData[$key] = ($monthlyData[$key] ?? 0) + (float) ($row['payment'] ?? 0);
            }
        }

        // Virements envoyés validés
        $totalPaid = Transfer::where('user_id', $user->id)
            ->where('type', 'send')
            ->where('status', Transfer::STATUS_COMPLETED)
            ->sum('amount');

        // Virements en attente de validation
        $pendingTransfers = Transfer::where('user_id', $user->id)
            ->where('type', 'send')
            ->whereIn('status', [Transfer::STATUS_PENDING, Transfer::STATUS_FEE_REQUIRED])
            ->get();

        $pendingAmount = $pendingTransfers->sum('amount');

        // Total crédits reçus sur le compte (admin + prêts finalisés)
        $totalReceived = AccountMovement::where('user_id', $user->id)
            ->where('type', 'credit')
            ->sum('amount');

        return view('client.app.analytics', compact(
            'user', 'loans', 'monthlyData',
            'totalPaid', 'totalReceived',
            'pendingTransfers', 'pendingAmount'
        ));
    }

    public function profile()
    {
        $user      = Auth::user();
        $transfers = Transfer::where('user_id', $user->id)->latest()->limit(3)->get();

        return view('client.app.profile', compact('user', 'transfers'));
    }

    public function updateProfile(Request $request)
    {
        $user      = Auth::user();
        $validated = $request->validate([
            'locale' => 'nullable|in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt',
            'phone'  => 'nullable|string|max:30',
        ]);

        if (!empty($validated['locale'])) {
            $user->update(['locale' => $validated['locale']]);
        }

        return back()->with('success', __('app.profile_saved'));
    }

    // ── Notifications ────────────────────────────────────────────────────────

    public function notifications()
    {
        $user          = Auth::user();
        $notifications = ClientNotification::where('user_id', $user->id)
            ->latest()
            ->get();

        ClientNotification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('client.app.notifications', compact('user', 'notifications'));
    }

    public function notificationRead(int $id)
    {
        $user = Auth::user();
        ClientNotification::where('id', $id)
            ->where('user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['ok' => true]);
    }

    public function notificationReadAll()
    {
        $user = Auth::user();
        ClientNotification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return back();
    }

    public function notificationCount()
    {
        $user    = Auth::user();
        $count   = ClientNotification::where('user_id', $user->id)->whereNull('read_at')->count();
        $newest  = ClientNotification::where('user_id', $user->id)->whereNull('read_at')->latest()->first();

        return response()->json([
            'count' => $count,
            'type'  => $newest?->type,
        ]);
    }

    // ── Edit profile ─────────────────────────────────────────────────────────

    public function paymentMethods()
    {
        $user = Auth::user();
        return view('client.app.payment-methods', compact('user'));
    }

    public function editProfile()
    {
        $user       = Auth::user();
        $pendingOtp = session()->has('profile_pending');

        return view('client.app.edit-profile', compact('user', 'pendingOtp'));
    }

    public function saveProfile(Request $request)
    {
        $user      = Auth::user();
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'email'   => 'required|email|max:191',
        ]);

        // Toujours sauvegarder nom, tel, adresse immédiatement
        $user->update([
            'name'    => $validated['name'],
            'phone'   => $validated['phone'] ?? $user->phone,
            'address' => $validated['address'] ?? $user->address,
        ]);

        // OTP uniquement si l'email est vraiment différent
        $newEmail = strtolower(trim($validated['email']));
        if ($newEmail !== strtolower(trim($user->email))) {
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            Cache::put('profile_otp_' . $user->id, Hash::make($otp), 600);
            session(['profile_pending' => ['email' => $newEmail]]);
            try {
                Mail::to($user->email)->send(new OtpMail($otp, $user));
            } catch (\Throwable) {
                return redirect()->route('client.app.profile')->with('success', __('app.profile_saved'));
            }
            return redirect()->route('client.app.profile.edit')->with('otp_sent', true);
        }

        return redirect()->route('client.app.profile')->with('success', __('app.profile_saved'));
    }

    public function confirmProfileOtp(Request $request)
    {
        $user    = Auth::user();
        $otp     = $request->input('otp');
        $pending = session('profile_pending');
        $cached  = Cache::get('profile_otp_' . $user->id);

        if (!$pending || !$cached || !Hash::check($otp, $cached)) {
            return back()->withErrors(['otp' => __('auth.otp_invalid')]);
        }

        $user->update(['email' => $pending['email']]);
        Cache::forget('profile_otp_' . $user->id);
        session()->forget('profile_pending');

        return redirect()->route('client.app.profile')->with('success', __('app.profile_saved'));
    }

    // ── Change password (logged in) ──────────────────────────────────────────

    public function changePassword()
    {
        $user = Auth::user();
        return view('client.app.change-password', compact('user'));
    }

    public function savePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => __('app.wrong_current_password')]);
        }

        $user->update(['password' => Hash::make($request->input('password'))]);

        return redirect()->route('client.app.profile')->with('success', __('app.password_changed'));
    }

    // ── Account movements ────────────────────────────────────────────────────

    public function movements()
    {
        $user = Auth::user();

        // Admin credit/debit operations
        $adminMvts = AccountMovement::where('user_id', $user->id)
            ->with('admin:id,name')
            ->get()
            ->map(fn ($m) => (object) [
                'source'       => 'account',
                'type'         => $m->type,
                'amount'       => (float) $m->amount,
                'currency'     => $m->currency,
                'label'        => $m->type === 'credit' ? __('app.mv_credit_label') : __('app.mv_debit_label'),
                'sub'          => $m->note ?? ($m->admin?->name ?? 'Système'),
                'balance_after' => (float) $m->balance_after,
                'has_balance'  => true,
                'status'       => 'completed',
                'created_at'   => $m->created_at,
            ]);

        // Client transfers (send = debit, receive = credit)
        $transfers = Transfer::where('user_id', $user->id)
            ->whereIn('status', [
                Transfer::STATUS_PENDING,
                Transfer::STATUS_COMPLETED,
                Transfer::STATUS_FEE_REQUIRED,
                Transfer::STATUS_REJECTED,
            ])
            ->get()
            ->map(fn ($t) => (object) [
                'source'       => 'transfer',
                'type'         => $t->type === 'send' ? 'debit' : 'credit',
                'amount'       => (float) $t->amount,
                'currency'     => $t->currency,
                'label'        => $t->type === 'send'
                    ? __('app.mv_transfer_sent') . ' ' . $t->beneficiary_name
                    : __('app.mv_transfer_received'),
                'sub'          => $t->reference . ($t->note ? ' — ' . $t->note : ''),
                'balance_after' => null,
                'has_balance'  => false,
                'status'       => $t->status,
                'created_at'   => $t->created_at,
            ]);

        $merged = $adminMvts->merge($transfers)
            ->sortByDesc('created_at')
            ->values();

        return view('client.app.movements', compact('user', 'merged'));
    }

    // ── PWA ─────────────────────────────────────────────────────────────────

    public function manifest()
    {
        $siteContact = SiteContact::current();
        $brandName   = $siteContact->name;
        [$iconTouch, $icon192, $icon192msk, $icon512, $icon512msk] = $this->pwaIconSet($siteContact);

        $data = [
            'name'             => $brandName . ' — Espace Client',
            'short_name'       => $brandName,
            'description'      => 'Gérez vos prêts, virements et documents en toute sécurité.',
            'start_url'        => '/app',
            'scope'            => '/app',
            'display'          => 'standalone',
            'orientation'      => 'any',
            'background_color' => '#04203D',
            'theme_color'      => '#04203D',
            'lang'             => app()->getLocale(),
            'categories'       => ['finance', 'business'],
            'icons'            => [
                ['src' => $iconTouch,   'sizes' => '180x180', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => $icon192,     'sizes' => '192x192', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => $icon192msk,  'sizes' => '192x192', 'type' => 'image/png', 'purpose' => 'maskable'],
                ['src' => $icon512,     'sizes' => '512x512', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => $icon512msk,  'sizes' => '512x512', 'type' => 'image/png', 'purpose' => 'maskable'],
            ],
            'shortcuts' => [
                [
                    'name'       => 'Mes dossiers',
                    'short_name' => 'Dossiers',
                    'url'        => '/app/loans',
                    'description'=> 'Consulter mes demandes de prêt',
                    'icons'      => [['src' => $icon192, 'sizes' => '192x192']],
                ],
                [
                    'name'       => 'Virements',
                    'short_name' => 'Virements',
                    'url'        => '/app/transfers',
                    'description'=> 'Effectuer ou suivre mes virements',
                    'icons'      => [['src' => $icon192, 'sizes' => '192x192']],
                ],
                [
                    'name'       => 'Support',
                    'short_name' => 'Support',
                    'url'        => '/app/support',
                    'description'=> 'Contacter le support client',
                    'icons'      => [['src' => $icon192, 'sizes' => '192x192']],
                ],
            ],
        ];

        return response()->json($data, 200, [
            'Content-Type'  => 'application/manifest+json',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    public function adminManifest()
    {
        $siteContact = SiteContact::current();
        $brandName   = $siteContact->name;
        [$iconTouch, $icon192, $icon192msk, $icon512, $icon512msk] = $this->pwaIconSet($siteContact);

        $data = [
            'name'             => $brandName . ' — Administration',
            'short_name'       => $brandName . ' Admin',
            'description'      => 'Gérez les prêts, clients et opérations ' . $brandName . '.',
            'start_url'        => '/admin',
            'scope'            => '/',
            'display'          => 'standalone',
            'orientation'      => 'any',
            'background_color' => '#04203D',
            'theme_color'      => '#04203D',
            'lang'             => app()->getLocale(),
            'categories'       => ['finance', 'business'],
            'icons'            => [
                ['src' => $iconTouch,  'sizes' => '180x180', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => $icon192,    'sizes' => '192x192', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => $icon192msk, 'sizes' => '192x192', 'type' => 'image/png', 'purpose' => 'maskable'],
                ['src' => $icon512,    'sizes' => '512x512', 'type' => 'image/png', 'purpose' => 'any'],
                ['src' => $icon512msk, 'sizes' => '512x512', 'type' => 'image/png', 'purpose' => 'maskable'],
            ],
            'shortcuts' => [
                [
                    'name'        => 'Tableau de bord',
                    'short_name'  => 'Dashboard',
                    'url'         => '/admin',
                    'description' => 'Vue d\'ensemble admin',
                    'icons'       => [['src' => $icon192, 'sizes' => '192x192']],
                ],
                [
                    'name'        => 'Demandes de prêt',
                    'short_name'  => 'Prêts',
                    'url'         => '/admin/loans',
                    'description' => 'Gérer les demandes de prêt',
                    'icons'       => [['src' => $icon192, 'sizes' => '192x192']],
                ],
            ],
        ];

        return response()->json($data, 200, [
            'Content-Type'  => 'application/manifest+json',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Retourne les 5 URLs d'icônes du manifeste (180 any, 192 any, 192 maskable,
     * 512 any, 512 maskable). Sans icône PWA personnalisée, on sert directement
     * les fichiers statiques (déjà aux bonnes dimensions). Avec une icône
     * personnalisée, on génère des variantes réellement redimensionnées via
     * /pwa-icon/{size}/{purpose} — l'ancien code déclarait 3 tailles différentes
     * pour un seul et même fichier, ce qui n'est jamais la bonne taille réelle
     * (source connue de plantages du "WebAPK" Android à l'installation/ouverture).
     */
    private function pwaIconSet(SiteContact $siteContact): array
    {
        $hasCustom = $siteContact->pwa_icon_path && Storage::disk('public')->exists($siteContact->pwa_icon_path);

        if (!$hasCustom) {
            return [
                '/images/apple-touch-icon.png',
                '/images/icon-192.png',
                '/images/icon-192.png',
                '/images/icon-512.png',
                '/images/icon-512.png',
            ];
        }

        return [
            route('pwa.icon', ['size' => 180, 'purpose' => 'any']),
            route('pwa.icon', ['size' => 192, 'purpose' => 'any']),
            route('pwa.icon', ['size' => 192, 'purpose' => 'maskable']),
            route('pwa.icon', ['size' => 512, 'purpose' => 'any']),
            route('pwa.icon', ['size' => 512, 'purpose' => 'maskable']),
        ];
    }

    /**
     * Sert l'icône PWA personnalisée redimensionnée à la taille demandée.
     * En "maskable", le logo est réduit dans une zone de sécurité centrale
     * (~66%) sur un fond plein, pour éviter que le masque adaptatif d'Android
     * ne rogne le contenu important.
     */
    public function pwaIconAsset(int $size, string $purpose)
    {
        abort_unless(in_array($size, [180, 192, 512], true), 404);
        abort_unless(in_array($purpose, ['any', 'maskable'], true), 404);

        $siteContact = SiteContact::current();
        if (!$siteContact->pwa_icon_path || !Storage::disk('public')->exists($siteContact->pwa_icon_path)) {
            abort(404);
        }

        $srcPath = Storage::disk('public')->path($siteContact->pwa_icon_path);
        $info    = @getimagesize($srcPath);
        if (!$info) {
            abort(404);
        }

        $src = match ($info['mime']) {
            'image/png'  => @imagecreatefrompng($srcPath),
            'image/jpeg' => @imagecreatefromjpeg($srcPath),
            'image/webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($srcPath) : null,
            'image/gif'  => @imagecreatefromgif($srcPath),
            default      => null,
        };
        if (!$src) {
            abort(404);
        }

        $canvas = imagecreatetruecolor($size, $size);
        imagesavealpha($canvas, true);

        if ($purpose === 'maskable') {
            // Fond plein (thème sombre de l'app) — jamais de transparence sur un maskable
            $bg = imagecolorallocate($canvas, 7, 26, 51); // #071A33
            imagefill($canvas, 0, 0, $bg);
            $inner  = (int) round($size * 0.66);
            $offset = (int) round(($size - $inner) / 2);
            imagecopyresampled($canvas, $src, $offset, $offset, 0, 0, $inner, $inner, imagesx($src), imagesy($src));
        } else {
            $transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
            imagefill($canvas, 0, 0, $transparent);
            imagecopyresampled($canvas, $src, 0, 0, 0, 0, $size, $size, imagesx($src), imagesy($src));
        }
        imagedestroy($src);

        ob_start();
        imagepng($canvas);
        $png = ob_get_clean();
        imagedestroy($canvas);

        return response($png, 200, [
            'Content-Type'  => 'image/png',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    public function serviceWorker()
    {
        $js = <<<'JS'
const CACHE = 'AURELIS CAPITAL GROUP-v8';
const ICON  = '/images/icon-192.png';
const BADGE = '/images/icon-badge.png';
const SHELL = ['/app', '/login'];

self.addEventListener('install', e => {
    e.waitUntil(
        caches.open(CACHE)
            .then(c => c.addAll(SHELL))
            .then(() => self.skipWaiting())
    );
});

self.addEventListener('activate', e => {
    e.waitUntil(
        caches.keys()
            .then(keys => Promise.all(keys.filter(k => k !== CACHE).map(k => caches.delete(k))))
            .then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', e => {
    if (e.request.method !== 'GET') return;

    const url = new URL(e.request.url);

    /* Ignorer extensions navigateur */
    if (!url.protocol.startsWith('http')) return;

    /* NE JAMAIS cacher storage/ — fichiers dynamiques uploadés */
    if (url.pathname.startsWith('/storage/')) return;

    if (url.pathname.startsWith('/build/assets/')) {
        e.respondWith(
            caches.open(CACHE).then(c =>
                c.match(e.request).then(cached => {
                    if (cached) return cached;
                    return fetch(e.request).then(resp => {
                        if (resp.ok) {
                            const clone = resp.clone();
                            c.put(e.request, clone);
                        }
                        return resp;
                    });
                })
            )
        );
        return;
    }

    e.respondWith(
        fetch(e.request)
            .then(resp => {
                if (resp.ok) {
                    const clone = resp.clone();
                    caches.open(CACHE).then(c => c.put(e.request, clone));
                }
                return resp;
            })
            .catch(() =>
                caches.match(e.request)
                    .then(cached => cached || caches.match('/app'))
            )
    );
});

/* ── Push notifications ── */
self.addEventListener('push', e => {
    let data = { title: 'AURELIS CAPITAL GROUP', body: '' };
    try { data = e.data ? e.data.json() : data; } catch (_) {}

    e.waitUntil(
        self.registration.showNotification(data.title || 'AURELIS CAPITAL GROUP', {
            body:    data.body  || '',
            icon:    ICON,
            badge:   BADGE,
            vibrate: [200, 100, 200],
            tag:     data.tag || 'AURELIS CAPITAL GROUP-notif',
            renotify: true,
            data:    { url: data.url || '/app/notifications' },
        })
    );
});

self.addEventListener('notificationclick', e => {
    e.notification.close();
    const target = (e.notification.data && e.notification.data.url) || '/app/notifications';
    e.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(list => {
            for (const c of list) {
                if (c.url.includes('/app') && 'focus' in c) {
                    c.navigate(target);
                    return c.focus();
                }
            }
            if (clients.openWindow) return clients.openWindow(target);
        })
    );
});
JS;
        return response($js, 200, ['Content-Type' => 'application/javascript']);
    }
}
