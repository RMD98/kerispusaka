<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        // DB::table('log')->insert([
        //     'user_name' => $request->user_name,
        //     'ip_address' => $request->ip(),
        //     'jenis_log' => 'Login',
        //     'keterangan' => 'User logged in successfully',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        $user = Auth::user();

    // Redirect based on role
        if ($user->role === 'peternak') {
            return redirect()->route('home');
        }
        // } elseif ($user->role === 'user') {
        // }
        else{
            return redirect()->route('dashboard');
        }
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
