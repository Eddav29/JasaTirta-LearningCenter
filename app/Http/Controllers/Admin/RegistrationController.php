<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserTrainingRegistration;
use App\Notifications\RegistrationConfirmed;
use App\Notifications\RegistrationRejected;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $query = UserTrainingRegistration::with(['user', 'trainingSchedule.training.category', 'verifiedBy']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->input('payment_status'));
        }

        // Search by user name or training name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('trainingSchedule.training', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $registrations = $query->latest()->paginate(15)->withQueryString();

        return view('pages.admin.registrations.index', compact('registrations'));
    }

    public function show(UserTrainingRegistration $registration): View
    {
        $registration->load(['user', 'trainingSchedule.training.category', 'verifiedBy']);

        return view('pages.admin.registrations.show', compact('registration'));
    }

    public function approve(UserTrainingRegistration $registration): RedirectResponse
    {
        if ($registration->payment_status !== 'pending_verification') {
            return back()->with('error', 'Status pembayaran harus pending verifikasi.');
        }

        $registration->update([
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        $registration->user->notify(new RegistrationConfirmed($registration));

        return back()->with('success', 'Pendaftaran berhasil disetujui.');
    }

    public function reject(Request $request, UserTrainingRegistration $registration): RedirectResponse
    {
        $validated = $request->validate([
            'rejected_reason' => 'required|string|max:1000',
        ]);

        $registration->update([
            'status' => 'cancelled',
            'payment_status' => 'refunded',
            'rejected_reason' => $validated['rejected_reason'],
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        $registration->user->notify(new RegistrationRejected($registration));

        // Redirect to refund creation page
        return redirect()
            ->route('admin.refunds.create', $registration)
            ->with('success', 'Pendaftaran berhasil ditolak. Silakan proses refund.');
    }
}
