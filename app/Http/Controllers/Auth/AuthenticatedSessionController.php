<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse|RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Kredensial yang diberikan tidak sesuai dengan data kami.',
                    'errors' => [
                        'email' => ['Kredensial yang diberikan tidak sesuai dengan data kami.']
                    ]
                ], 422);
            }

            return back()->withErrors([
                'email' => 'Kredensial yang diberikan tidak sesuai dengan data kami.',
            ])->withInput($request->except('password'));
        }

        $user = Auth::user();

        if ($request->expectsJson()) {
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json([
                'message' => 'Login berhasil',
                'user' => $user,
                'token' => $token
            ]);
        }

        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            $user = $request->user();
            
            if ($user) {
                // Revoke current token
                $user->currentAccessToken()->delete();
            }

            return response()->json([
                'message' => 'Logout berhasil'
            ]);
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
