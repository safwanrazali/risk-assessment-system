<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenggunaRequest;
use App\Mail\WelcomeEmail;
use App\Models\Agensi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    public function index(): View
    {
        $items = User::latest()->paginate();
        return view('pengguna.index', compact('items'));
    }

    public function create(): View
    {
        $pengguna = new User();
        $agensis = Agensi::orderBy('nama_agensi')->get();
        return view('pengguna.form', compact('pengguna','agensis'));
    }

    public function store(PenggunaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $temporaryPassword = $data['password'];
        $data['password'] = Hash::make($data['password']);
        $data['must_change_password'] = true;
        
        $user = User::create($data);

        // Queue welcome email with temporary password
        try {
            // dd(config('mail'));
            Mail::to($user->email)->send(new WelcomeEmail($user, $temporaryPassword));
            \Log::info('Welcome email sent successfully to ' . $user->email);
        } catch (\Exception $e) {
            // Log error but don't fail user creation
            \Log::error('Failed to send welcome email: ' . $e->getMessage());
        }

        return redirect()->route(app()->request->routeIs('admin.*') ? 'admin.pengguna.index' : 'agensi.pengguna.index')
            ->with('success', 'Pengguna berjaya didaftarkan. Email telah dihantar kepada pengguna.');
    }

    public function edit(User $pengguna): View
    {
        $agensis = Agensi::orderBy('nama_agensi')->get();
        return view('pengguna.form', compact('pengguna','agensis'));
    }

    public function update(PenggunaRequest $request, User $pengguna): RedirectResponse
    {
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $pengguna->update($data);
        return redirect()->route(app()->request->routeIs('admin.*') ? 'admin.pengguna.index' : 'agensi.pengguna.index')
            ->with('success', 'Pengguna berjaya dikemas kini.');
    }

    public function destroy(User $pengguna): RedirectResponse
    {
        $pengguna->delete();
        return redirect()->back()->with('success', 'Pengguna berjaya dipadam.');
    }
}
