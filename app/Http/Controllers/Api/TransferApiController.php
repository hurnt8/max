<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AdminTransferMail;
use App\Models\AdminNotification;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TransferApiController extends Controller
{
    // GET /api/transfers
    public function index(Request $request): JsonResponse
    {
        $user      = $request->user();
        $transfers = Transfer::where('user_id', $user->id)->latest()->get()
            ->map(fn ($t) => $this->formatTransfer($t));

        return response()->json([
            'balance'   => (float) $user->balance,
            'currency'  => $user->currency ?? 'EUR',
            'transfers' => $transfers,
        ]);
    }

    // POST /api/transfers/send
    // Body: { amount, beneficiary_name, beneficiary_iban, note? }
    public function send(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'amount'           => 'required|numeric|min:1',
            'beneficiary_name' => 'required|string|max:100',
            'beneficiary_iban' => 'required|string|max:50',
            'note'             => 'nullable|string|max:255',
        ]);

        $amount = (float) $validated['amount'];

        if ((float) $user->balance < 0) {
            return response()->json(['message' => 'Solde négatif, virement impossible.'], 422);
        }

        $transfer = null;

        try {
            DB::transaction(function () use ($user, $validated, $amount, &$transfer) {
                $fresh = User::lockForUpdate()->find($user->id);

                if ($amount > (float) $fresh->balance) {
                    throw new \DomainException('Solde insuffisant.');
                }

                $transfer = Transfer::create([
                    'user_id'          => $fresh->id,
                    'reference'        => Transfer::generateReference(),
                    'type'             => 'send',
                    'amount'           => $amount,
                    'currency'         => $fresh->currency ?? config('credixa.default_currency', 'EUR'),
                    'beneficiary_name' => $validated['beneficiary_name'],
                    'beneficiary_iban' => $validated['beneficiary_iban'],
                    'note'             => $validated['note'] ?? null,
                    'status'           => Transfer::STATUS_PENDING,
                ]);

                $fresh->decrement('balance', $amount);

                $this->notifyAdmins($fresh, $transfer);
            });
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message'  => 'Virement soumis avec succès.',
            'transfer' => $this->formatTransfer($transfer),
        ], 201);
    }

    private function formatTransfer(Transfer $t): array
    {
        return [
            'id'               => $t->id,
            'reference'        => $t->reference,
            'type'             => $t->type,
            'amount'           => (float) $t->amount,
            'currency'         => $t->currency,
            'beneficiary_name' => $t->beneficiary_name,
            'beneficiary_iban' => $t->beneficiary_iban ?? null,
            'note'             => $t->note,
            'status'           => $t->status,
            'status_label'     => $t->statusLabel(),
            'created_at'       => $t->created_at?->toISOString(),
        ];
    }

    private function notifyAdmins(User $client, Transfer $transfer): void
    {
        $adminIds = collect();
        if ($client->created_by) $adminIds->push($client->created_by);
        $loanAdminId = $client->clientLoans()->whereNotNull('admin_id')->value('admin_id');
        if ($loanAdminId) $adminIds->push($loanAdminId);
        $adminIds = $adminIds->unique();
        if ($adminIds->isEmpty()) $adminIds = User::role('super-admin')->pluck('id');

        $body = 'Virement de ' . number_format($transfer->amount, 2, ',', ' ') . ' '
            . $transfer->currency . ' vers ' . $transfer->beneficiary_name;

        foreach ($adminIds as $adminId) {
            AdminNotification::forAdmin($adminId, 'transfer', 'Virement en attente — ' . $client->name, $body, [
                'transfer_id' => $transfer->id,
                'client_id'   => $client->id,
            ]);
            $admin = User::find($adminId);
            if ($admin) {
                try { Mail::to($admin->email)->send(new AdminTransferMail($client, $transfer)); } catch (\Throwable) {}
            }
        }
    }
}
