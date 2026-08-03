<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::orderBy('sort_order')->get()->map(function (Language $lang) {
            $lang->has_files = Language::hasTranslationFiles($lang->code);
            $lang->completeness = $lang->has_files ? Language::completeness($lang->code) : 0;
            return $lang;
        });

        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($error = $this->activationError($validated)) {
            return back()->withErrors(['code' => $error])->withInput();
        }

        Language::create($validated);

        $this->clearRouteCacheIfNeeded();

        return redirect()->route('admin.languages.index')
                         ->with('success', 'Langue ajoutée.');
    }

    public function edit(Language $language)
    {
        $hasFiles = Language::hasTranslationFiles($language->code);
        $completeness = $hasFiles ? Language::completeness($language->code) : 0;

        return view('admin.languages.edit', compact('language', 'hasFiles', 'completeness'));
    }

    public function update(Request $request, Language $language)
    {
        $validated = $this->validated($request, $language->id);

        if ($error = $this->activationError($validated)) {
            return back()->withErrors(['code' => $error])->withInput();
        }

        $language->update($validated);

        $this->clearRouteCacheIfNeeded();

        return redirect()->route('admin.languages.index')
                         ->with('success', 'Langue mise à jour.');
    }

    public function destroy(Language $language)
    {
        $language->delete();

        $this->clearRouteCacheIfNeeded();

        return back()->with('success', 'Langue supprimée.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $request->merge(['code' => strtolower((string) $request->input('code'))]);

        $validated = $request->validate([
            'code'        => ['required', 'string', 'size:2', 'regex:/^[a-z]{2}$/', $ignoreId ? "unique:languages,code,{$ignoreId}" : 'unique:languages,code'],
            'native_name' => ['required', 'string', 'max:100'],
            'flag_asset'  => ['nullable', 'string', 'max:100'],
            'is_active'   => ['boolean'],
            'sort_order'  => ['nullable', 'integer'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }

    private function activationError(array $validated): ?string
    {
        if ($validated['is_active'] && !Language::hasTranslationFiles($validated['code'])) {
            return "Aucun dossier de traduction lang/{$validated['code']} trouvé. Ajoutez les fichiers de traduction avant d'activer cette langue.";
        }

        return null;
    }

    private function clearRouteCacheIfNeeded(): void
    {
        if (app()->routesAreCached()) {
            Artisan::call('route:clear');
        }
    }
}
