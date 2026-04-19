<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

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
        $request->session()->regenerate();

        $response = Http::post(config('services.jwt.url') . '/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful() && $response->json('refreshToken')) {
            Session::put('refreshToken', $response->json('refreshToken'));
            Session::put('user_email', $request->email);
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $token = Session::get('refreshToken');
        if ($token) {
            Http::withToken($token)->get(config('services.jwt.url') . '/logout');
        }

        Session::forget('refreshToken');
        Session::flush();
        return redirect('/');
    }
}
