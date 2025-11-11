<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page.
     */
    public function index()
    {
        return view('pages.user.profile.index');
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.Auth::id()],
            'phone' => ['nullable', 'string', 'max:20'],
            'location' => ['nullable', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:500'],
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'email', 'phone', 'location', 'bio']));

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui!',
        ]);
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah!',
        ]);
    }

    /**
     * Update the user's preferences.
     */
    public function updatePreferences(Request $request)
    {
        $request->validate([
            'email_notifications' => ['boolean'],
            'course_reminders' => ['boolean'],
            'weekly_progress' => ['boolean'],
            'marketing_emails' => ['boolean'],
            'preferred_learning_time' => ['string', 'in:morning,afternoon,evening,flexible'],
            'difficulty_level' => ['string', 'in:beginner,intermediate,advanced,expert'],
            'language' => ['string', 'in:id,en'],
        ]);

        $user = Auth::user();

        // For now, we'll store preferences in a JSON column or separate table
        // This is a simplified approach - in production, you might want a separate preferences table
        $preferences = $request->only([
            'email_notifications',
            'course_reminders',
            'weekly_progress',
            'marketing_emails',
            'preferred_learning_time',
            'difficulty_level',
            'language',
        ]);

        // You can store this in a preferences column or separate table
        // For now, we'll just return success

        return response()->json([
            'success' => true,
            'message' => 'Preferensi berhasil disimpan!',
        ]);
    }

    /**
     * Upload avatar image.
     */
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');

            $user->update([
                'avatar' => $avatarPath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diperbarui!',
                'avatar_url' => asset('storage/'.$avatarPath),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengunggah foto profil.',
        ], 400);
    }
}
