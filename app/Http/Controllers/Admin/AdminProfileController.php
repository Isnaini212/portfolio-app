<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    /**
     * Display the admin account credentials edit form.
     */
    public function edit(): View
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the admin account credentials (email and password).
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'email'             => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password'  => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password'      => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->filled('email') && $request->email !== $user->email) {
            $user->email = $request->email;
        }

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Kredensial akun admin berhasil diperbarui.');
    }
}
