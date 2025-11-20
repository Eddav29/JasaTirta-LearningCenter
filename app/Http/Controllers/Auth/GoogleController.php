<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class GoogleController extends Controller
{
    public function redirect(): RedirectResponse
    {
        Log::info('Google OAuth redirect initiated');

        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            Log::info('Google OAuth callback initiated');

            $googleUser = Socialite::driver('google')->user();

            Log::info('Google user data received', [
                'id' => $googleUser->getId(),
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'avatar' => $googleUser->getAvatar(),
            ]);

            // Find existing user by Google ID or email
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($user) {
                Log::info('Existing user found', ['user_id' => $user->id, 'email' => $user->email]);

                // Update existing user with Google data
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'email_verified_at' => now(),
                ]);

                Log::info('User updated successfully');
            } else {
                Log::info('Creating new user from Google data');

                // Ensure 'user' role exists
                $userRole = Role::firstOrCreate(['name' => 'user']);

                // Create new user
                $nameParts = explode(' ', $googleUser->getName(), 2);
                $user = User::create([
                    'first_name' => $nameParts[0] ?? $googleUser->getName(),
                    'last_name' => $nameParts[1] ?? '',
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random(24)),
                ]);

                // Assign default user role
                $user->assignRole('user');

                Log::info('New user created successfully', ['user_id' => $user->id]);
            }

            // Login the user
            Auth::login($user);

            Log::info('User logged in successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);

            // Redirect to dashboard
            return redirect()->intended(route('user.dashboard'));

        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            Log::error('Google OAuth Invalid State Exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('login')
                ->withErrors(['google' => 'Session expired. Please try logging in again.']);

        } catch (\Exception $e) {
            Log::error('Google OAuth Exception', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('login')
                ->withErrors(['google' => 'Google authentication failed: '.$e->getMessage()]);
        }
    }
}
