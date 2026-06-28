<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccountMovement;
use App\Models\ClientNotification;
use App\Models\Invoice;
use App\Models\LoanRequest;
use App\Models\Transfer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientApiController extends Controller
{
    // GET /api/dashboard
    public function dashboard(Request $request): JsonResponse
    {
        $user = $request->user();

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
            ->whereNull('read_at')->count();

        $adminMvts = AccountMovement::where('user_id', $user->id)
            ->latest()->limit(10)->get()
            ->map(fn ($m) => [
                'source'     => 'account',
                'type'       => $m->type,
                'amount'     => (float) $m->amount,
                'currency'   => $m->currency,
                'label'      => $m->type === 'credit'
                    ? __('api.movement.credit_received')
                    : __('api.movement.debit_done'),
                'sub'        => $m->note ?? '',
                'status'     => 'completed',
                'created_at' => $m->created_at?->toISOString(),
            ]);

        $recentTransfers = Transfer::where('user_id', $user->id)
            ->whereIn('status', [
                Transfer::STATUS_PENDING,
                Transfer::STATUS_COMPLETED,
                Transfer::STATUS_FEE_REQUIRED,
                Transfer::STATUS_REJECTED,
            ])
            ->latest()->limit(10)->get()
            ->map(fn ($t) => [
                'source'     => 'transfer',
                'type'       => $t->type === 'send' ? 'debit' : 'credit',
                'amount'     => (float) $t->amount,
                'currency'   => $t->currency,
                'label'      => $t->type === 'send'
                    ? __('api.movement.transfer_to', ['name' => $t->beneficiary_name])
                    : __('api.movement.transfer_received'),
                'sub'        => $t->reference,
                'status'     => $t->status,
                'created_at' => $t->created_at?->toISOString(),
            ]);

        $recentActivity = $adminMvts->merge($recentTransfers)
            ->sortByDesc('created_at')->take(5)->values();

        return response()->json([
            'user' => [
                'id'       => $user->id,
                'name'     => $user->name,
                'email'    => $user->email,
                'balance'  => (float) $user->balance,
                'currency' => $user->currency ?? 'EUR',
                'avatar'   => strtoupper(substr($user->name, 0, 1)),
            ],
            'active_loans'    => $activeLoans->count(),
            'pending_loans'   => $pendingLoans->count(),
            'unread_notifs'   => $unreadCount,
            'recent_activity' => $recentActivity,
        ]);
    }

    // GET /api/loans
    public function loans(Request $request): JsonResponse
    {
        $user  = $request->user();
        $loans = LoanRequest::where('client_id', $user->id)
            ->where('status', '!=', LoanRequest::STATUS_DRAFT)
            ->latest()->get()
            ->map(fn ($l) => $this->formatLoan($l));

        return response()->json(['loans' => $loans]);
    }

    // GET /api/loans/{id}
    public function loanShow(Request $request, int $id): JsonResponse
    {
        $user = $request->user();
        $loan = LoanRequest::where('client_id', $user->id)->findOrFail($id);
        $loan->load('admin:id,name');

        $principal = (float) $loan->amount;
        $total     = (float) $loan->total_with_interest;
        $interest  = max(0, $total - $principal);

        return response()->json([
            'loan'      => $this->formatLoan($loan),
            'principal' => $principal,
            'interest'  => $interest,
            'total'     => $total,
            'admin'     => $loan->admin ? ['id' => $loan->admin->id, 'name' => $loan->admin->name] : null,
            'amortization_schedule' => $loan->amortization_schedule ?? [],
        ]);
    }

    // GET /api/movements
    public function movements(Request $request): JsonResponse
    {
        $user = $request->user();

        $adminMvts = AccountMovement::where('user_id', $user->id)
            ->latest()->get()
            ->map(fn ($m) => [
                'source'        => 'account',
                'type'          => $m->type,
                'amount'        => (float) $m->amount,
                'currency'      => $m->currency,
                'label'         => $m->type === 'credit'
                    ? __('api.movement.credit_received')
                    : __('api.movement.debit_done'),
                'sub'           => $m->note ?? __('api.movement.system'),
                'balance_after' => (float) $m->balance_after,
                'status'        => 'completed',
                'created_at'    => $m->created_at?->toISOString(),
            ]);

        $transfers = Transfer::where('user_id', $user->id)
            ->whereIn('status', [
                Transfer::STATUS_PENDING,
                Transfer::STATUS_COMPLETED,
                Transfer::STATUS_FEE_REQUIRED,
                Transfer::STATUS_REJECTED,
            ])
            ->latest()->get()
            ->map(fn ($t) => [
                'source'        => 'transfer',
                'type'          => $t->type === 'send' ? 'debit' : 'credit',
                'amount'        => (float) $t->amount,
                'currency'      => $t->currency,
                'label'         => $t->type === 'send'
                    ? __('api.movement.transfer_to', ['name' => $t->beneficiary_name])
                    : __('api.movement.transfer_received'),
                'sub'           => $t->reference . ($t->note ? ' — ' . $t->note : ''),
                'balance_after' => null,
                'status'        => $t->status,
                'created_at'    => $t->created_at?->toISOString(),
            ]);

        $merged = $adminMvts->merge($transfers)
            ->sortByDesc('created_at')->values();

        return response()->json(['movements' => $merged]);
    }

    // GET /api/invoices
    public function invoices(Request $request): JsonResponse
    {
        $user     = $request->user();
        $invoices = Invoice::where('client_id', $user->id)
            ->whereIn('status', [Invoice::STATUS_SENT, Invoice::STATUS_PAID, Invoice::STATUS_CANCELLED])
            ->latest()->get()
            ->map(fn ($i) => [
                'id'         => $i->id,
                'reference'  => $i->reference,
                'amount'     => (float) $i->amount,
                'currency'   => $i->currency ?? 'EUR',
                'status'     => $i->status,
                'due_date'   => $i->due_date?->toDateString(),
                'created_at' => $i->created_at?->toISOString(),
            ]);

        return response()->json(['invoices' => $invoices]);
    }

    // GET /api/analytics
    public function analytics(Request $request): JsonResponse
    {
        $user  = $request->user();
        $loans = LoanRequest::where('client_id', $user->id)
            ->where('status', '!=', LoanRequest::STATUS_REJECTED)
            ->whereNotNull('amortization_schedule')
            ->get();

        $monthlyData = [];
        foreach ($loans as $loan) {
            foreach ($loan->amortization_schedule ?? [] as $row) {
                $key = 'M' . $row['month'];
                $monthlyData[$key] = ($monthlyData[$key] ?? 0) + (float) ($row['payment'] ?? 0);
            }
        }

        $totalPaid = Transfer::where('user_id', $user->id)
            ->where('type', 'send')->where('status', Transfer::STATUS_COMPLETED)->sum('amount');

        $totalReceived = AccountMovement::where('user_id', $user->id)
            ->where('type', 'credit')->sum('amount');

        $pendingTransfers = Transfer::where('user_id', $user->id)
            ->where('type', 'send')
            ->whereIn('status', [Transfer::STATUS_PENDING, Transfer::STATUS_FEE_REQUIRED])
            ->sum('amount');

        return response()->json([
            'monthly_data'      => $monthlyData,
            'total_paid'        => (float) $totalPaid,
            'total_received'    => (float) $totalReceived,
            'pending_transfers' => (float) $pendingTransfers,
        ]);
    }

    private function formatLoan(LoanRequest $loan): array
    {
        return [
            'id'              => $loan->id,
            'reference'       => $loan->reference,
            'amount'          => (float) $loan->amount,
            'currency'        => $loan->currency ?? 'EUR',
            'status'          => $loan->status,
            'status_label'    => $loan->statusLabel(),
            'interest_rate'   => (float) $loan->interest_rate,
            'duration_months' => $loan->duration_months,
            'start_date'      => $loan->start_date?->toDateString(),
            'created_at'      => $loan->created_at?->toISOString(),
        ];
    }
}
