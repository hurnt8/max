<x-mail::message>
# {{ __('message.loan_admin_subject') }}

{{ __('message.loan_admin_intro') }}

---

**{{ __('loan.label_name') }} :** {{ $data['name'] }}

**{{ __('loan.label_email') }} :** {{ $data['email'] }}

**{{ __('loan.label_phone') }} :** {{ $data['phone'] }}

**{{ __('loan.label_amount') }} :** {{ number_format($data['amount'], 0, ',', ' ') }} {{ $data['currency'] ?? \App\Models\Currency::default() }}

@if (!empty($data['address']))
**{{ __('loan.label_residence') }} :** {{ $data['address'] }}

@endif
@if (!empty($data['profession']))
**{{ __('loan.label_profession') }} :** {{ $data['profession'] }}

@endif
@if (isset($data['monthly_income']))
**{{ __('loan.label_monthly_income') }} :** {{ number_format($data['monthly_income'], 0, ',', ' ') }} EUR

@endif
@if (!empty($data['reference']))
**Réf. :** {{ $data['reference'] }}
@endif

@if (!empty($data['objet']))
---

**{{ __('loan.label_objet') }} :** {{ $data['objet'] }}
@endif

<x-mail::subcopy>
{{ __('message.no_reply_notice') }}
</x-mail::subcopy>
</x-mail::message>
