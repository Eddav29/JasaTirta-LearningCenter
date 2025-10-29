<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     */
    public function store(ForgotPasswordRequest $request): JsonResponse|RedirectResponse
    {
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Link reset password telah dikirim ke email Anda.'
                ]);
            }

            return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
        }

        if ($request->expectsJson()) {
            throw ValidationException::withMessages([
                'email' => [trans($status)],
            ]);
        }

        return back()->withErrors([
            'email' => trans($status),
        ]);
    }
}
