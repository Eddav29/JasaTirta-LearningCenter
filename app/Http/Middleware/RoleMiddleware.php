<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        // Get user roles (assuming Spatie permission package)
        $userRoles = $request->user()->roles->pluck('name')->toArray();

        // Check if user has any of the required roles
        foreach ($roles as $role) {
            if (in_array($role, $userRoles)) {
                return $next($request);
            }
        }

        // If user doesn't have required role, redirect based on their role
        return $this->redirectBasedOnRole($request->user());
    }

    /**
     * Redirect user based on their role.
     */
    protected function redirectBasedOnRole($user): Response
    {
        $userRoles = $user->roles->pluck('name')->toArray();

        if (in_array('admin', $userRoles) || in_array('super-admin', $userRoles)) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        if (in_array('instructor', $userRoles)) {
            return redirect()->route('instructor.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        // Default to user dashboard
        return redirect()->route('user.dashboard')
            ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}
