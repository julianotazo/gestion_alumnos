<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile'); // resources/views/profile.blade.php
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'professional_url' => ['nullable', 'url', 'max:255'],
        ]);

        $user->update($validated);

        return back()->with('status', 'Perfil actualizado correctamente.');
    }
}
