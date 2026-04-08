<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ChangePasswordController extends Controller
{
    /**
     * Show the change password form.
     */
    public function show(): View
    {
        return view('auth.change-password');
    }

    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'Password diperlukan.',
            'password.min' => 'Password harus sekurang-kurangnya 8 aksara.',
            'password.confirmed' => 'Pengesahan password tidak sepadan.',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
            'must_change_password' => false,
        ]);

        $role = $user->peranan;
        $message = 'Password berjaya ditukar.';
        
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', $message);
        }
        return redirect()->route('agensi.dashboard')->with('success', $message);
    }
}
