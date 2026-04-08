<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function show(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = (bool) $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Check if user must change password on first login
            if (Auth::user()->must_change_password) {
                return redirect()->route('auth.change-password');
            }
            
            $role = Auth::user()->peranan;
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('agensi.dashboard');
        }

        return back()->withErrors([
            'email' => 'Maklumat emel / kata laluan tidak sah.',
        ])->onlyInput('email');
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
