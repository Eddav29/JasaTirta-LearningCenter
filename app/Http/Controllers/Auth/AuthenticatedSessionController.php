<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                        'email' => ['Kredensial yang diberikan tidak sesuai dengan data kami.'],
                    ],
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
                'token' => $token,
            ]);
        }

        $request->session()->regenerate();

        // Redirect based on user role
        return $this->redirectBasedOnRole($user);
    }

    /**
     * Redirect user to appropriate dashboard based on their role.
     */
    protected function redirectBasedOnRole($user): RedirectResponse
    {
        // Get user roles (assuming Spatie permission package is installed)
        $userRoles = $user->roles->pluck('name')->toArray();

        // Admin or Super Admin
        if (in_array('admin', $userRoles) || in_array('super-admin', $userRoles)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // Instructor
        if (in_array('instructor', $userRoles)) {
            return redirect()->intended(route('instructor.dashboard'));
        }

        // Default to user dashboard for participants and other roles
        return redirect()->intended(route('user.dashboard'));
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
                'message' => 'Logout berhasil',
            ]);
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
