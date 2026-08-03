<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::orderBy('sort_order')->get();

        return view('admin.currencies.index', compact('currencies'));
    }

    public function create()
    {
        return view('admin.currencies.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        $currency = Currency::create($validated);

        if ($currency->is_default) {
            Currency::where('id', '!=', $currency->id)->update(['is_default' => false]);
        }

        return redirect()->route('admin.currencies.index')
                         ->with('success', 'Devise ajoutée.');
    }

    public function edit(Currency $currency)
    {
        return view('admin.currencies.edit', compact('currency'));
    }

    public function update(Request $request, Currency $currency)
    {
        $validated = $this->validated($request, $currency->id);

        $currency->update($validated);

        if ($currency->is_default) {
            Currency::where('id', '!=', $currency->id)->update(['is_default' => false]);
        }

        return redirect()->route('admin.currencies.index')
                         ->with('success', 'Devise mise à jour.');
    }

    public function destroy(Currency $currency)
    {
        if ($currency->is_default) {
            return back()->with('error', 'Impossible de supprimer la devise par défaut. Définissez-en une autre par défaut avant.');
        }

        $currency->delete();

        return back()->with('success', 'Devise supprimée.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $request->merge(['code' => strtoupper((string) $request->input('code'))]);

        $validated = $request->validate([
            'code'           => ['required', 'string', 'size:3', 'regex:/^[A-Z]{3}$/', $ignoreId ? "unique:currencies,code,{$ignoreId}" : 'unique:currencies,code'],
            'name'           => ['required', 'string', 'max:100'],
            'symbol'         => ['required', 'string', 'max:10'],
            'flag_emoji'     => ['nullable', 'string', 'max:10'],
            'preset_amounts' => ['nullable', 'string'],
            'is_active'      => ['boolean'],
            'is_default'     => ['boolean'],
            'sort_order'     => ['nullable', 'integer'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_default'] = $request->boolean('is_default');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if (!empty($validated['preset_amounts'])) {
            $validated['preset_amounts'] = collect(explode(',', $validated['preset_amounts']))
                ->map(fn ($v) => (int) trim($v))
                ->filter()
                ->values()
                ->all();
        } else {
            $validated['preset_amounts'] = null;
        }

        return $validated;
    }
}
