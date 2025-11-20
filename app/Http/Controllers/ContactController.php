<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.landing.contact.index');
    }

    public function store(Request $request)
    {
        // Check if user is authenticated
        if (! Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu untuk mengirim pesan.',
                'redirect' => route('login'),
            ], 401);
        }

        // Rate limiting: max 3 messages per 10 minutes per user
        $key = 'contact-message:'.Auth::id();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);

            return response()->json([
                'success' => false,
                'message' => "Anda telah mencapai batas maksimal pengiriman pesan. Silakan coba lagi dalam {$minutes} menit.",
            ], 429);
        }

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
        ]);

        // Check for duplicate message in last 5 minutes (spam protection)
        $recentDuplicate = ContactMessage::where('user_id', Auth::id())
            ->where('subject', $validated['subject'])
            ->where('message', $validated['message'])
            ->where('created_at', '>=', now()->subMinutes(5))
            ->exists();

        if ($recentDuplicate) {
            return response()->json([
                'success' => false,
                'message' => 'Pesan yang sama telah dikirim sebelumnya. Silakan tunggu beberapa saat sebelum mengirim pesan yang sama.',
            ], 422);
        }

        $contactMessage = ContactMessage::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'phone' => $validated['phone'] ?? null,
            'company' => $validated['company'] ?? null,
            'status' => 'unread',
        ]);

        // Hit the rate limiter
        RateLimiter::hit($key, 600); // 600 seconds = 10 minutes

        return response()->json([
            'success' => true,
            'message' => 'Pesan Anda telah berhasil dikirim. Tim kami akan segera menghubungi Anda.',
            'data' => $contactMessage,
        ]);
    }
}
