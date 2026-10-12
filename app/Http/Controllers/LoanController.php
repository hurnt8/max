<?php

namespace App\Http\Controllers;

use App\Mail\LoanMail;
use App\Mail\LoanConfirmationMail;
use App\Models\Currency;
use App\Models\LoanRequest;
use App\Models\LoanSetting;
use App\Services\LoanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoanController extends Controller
{
    public function __construct(private LoanService $loanService) {}

    public function simulate(Request $request)
    {
        $validated = $request->validate([
            'amount'        => 'required|numeric|min:1',
            'duration'      => 'required|integer|min:1',
            'interest_rate' => 'required|numeric|min:0',
        ]);

        $monthlyPayment = $this->loanService->calculateMonthlyPayment(
            (float) $validated['amount'],
            (int)   $validated['duration'],
            (float) $validated['interest_rate']
        );

        $amortizationSchedule = $this->loanService->generateAmortizationSchedule(
            (float) $validated['amount'],
            (int)   $validated['duration'],
            (float) $validated['interest_rate'],
            $monthlyPayment
        );

        return view('simulate', [
            'loan'                 => (object) $validated,
            'monthlyPayment'       => $monthlyPayment,
            'amortizationSchedule' => $amortizationSchedule,
        ]);
    }

    public function sendMail(Request $request)
    {
        // Piège à robots : le champ "website" est invisible pour les humains.
        if (filled($request->input('website'))) {
            return back()->with('success', __('message.success_loan'));
        }

        $setting = LoanSetting::current();

        $validated = $request->validate([
            'last_name'      => ['required', 'string', 'max:120'],
            'first_name'     => ['required', 'string', 'max:120'],
            'phone'          => ['required', 'string', 'max:30', 'regex:/^\+?[0-9\s().-]{6,30}$/'],
            'email'          => ['required', 'email:rfc', 'max:190'],
            'address'        => ['required', 'string', 'max:500'],
            'profession'     => ['required', 'string', 'max:150'],
            'monthly_income' => ['required', 'numeric', 'min:0', 'max:1000000'],
            'amount'         => ['required', 'numeric', 'min:' . (float) $setting->min_amount, 'max:' . (float) $setting->max_amount],
            'objet'          => ['required', 'string', 'min:10', 'max:2000'],
            'consent'        => ['accepted'],
        ]);

        $locale = $request->input('locale', 'fr');
        if (!in_array($locale, ['fr', 'en', 'pl', 'es', 'bg', 'hu', 'it', 'de', 'lt', 'ro', 'lv', 'nl', 'pt', 'hr'], true)) {
            $locale = 'fr';
        }
        App::setLocale($locale);

        $fullName = trim($validated['first_name'] . ' ' . $validated['last_name']);

        // Enregistrement effectif de la demande AVANT toute notification.
        $loan = LoanRequest::create([
            'reference'    => LoanRequest::generateReference(),
            'name'         => $fullName,
            'email'        => $validated['email'],
            'phone'        => $validated['phone'],
            'address'      => $validated['address'],
            'amount'       => $validated['amount'],
            'currency'     => 'EUR',
            'darly'        => 24,
            'objet'        => Str::limit($validated['objet'], 250, ''),
            'subject'      => null,
            'status'       => LoanRequest::STATUS_PENDING,
            'contract_language' => $locale,
            'extra_fields' => [
                'last_name'      => $validated['last_name'],
                'first_name'     => $validated['first_name'],
                'profession'     => $validated['profession'],
                'monthly_income' => $validated['monthly_income'],
                'motive'         => $validated['objet'],
                'consent_at'     => now()->toIso8601String(),
            ],
        ]);

        $data = [
            'name'           => $fullName,
            'email'          => $validated['email'],
            'phone'          => $validated['phone'],
            'address'        => $validated['address'],
            'profession'     => $validated['profession'],
            'monthly_income' => $validated['monthly_income'],
            'amount'         => $validated['amount'],
            'currency'       => 'EUR',
            'darly'          => 24,
            'subject'        => null,
            'objet'          => $validated['objet'],
            'reference'      => $loan->reference,
        ];

        // La demande est enregistrée : un échec d'e-mail ne doit pas la faire perdre.
        try {
            Mail::to($setting->notification_email)->send(new LoanMail($data, $locale));
            Mail::to($data['email'])->send(new LoanConfirmationMail($data, $locale));
        } catch (\Throwable $e) {
            report($e);
        }

        return back()
            ->with('success', __('message.success_loan'))
            ->with('loan_reference', $loan->reference);
    }
}
