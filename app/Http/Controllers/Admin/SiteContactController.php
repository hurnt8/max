<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContact;
use Illuminate\Http\Request;

class SiteContactController extends Controller
{
    public function edit()
    {
        $contact = SiteContact::current();
        return view('admin.site-contacts.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'address_1' => ['nullable', 'string', 'max:255'],
            'address_2' => ['nullable', 'string', 'max:255'],
            'address_3' => ['nullable', 'string', 'max:255'],
            'phone_1'   => ['nullable', 'string', 'max:255'],
            'phone_2'   => ['nullable', 'string', 'max:255'],
            'email'     => ['nullable', 'email', 'max:255'],
        ]);

        SiteContact::current()->update($validated);

        return back()->with('success', 'Coordonnées mises à jour.');
    }
}
