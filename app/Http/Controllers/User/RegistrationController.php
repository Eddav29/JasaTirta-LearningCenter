<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegistrationRequest;
use App\Models\TrainingSchedule;
use App\Models\UserTrainingRegistration;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function index(): View
    {
        $registrations = UserTrainingRegistration::with(['trainingSchedule.training.category'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pages.user.registrations.index', compact('registrations'));
    }

    public function create(TrainingSchedule $schedule): View
    {
        $schedule->load('training.category');

        return view('pages.user.registrations.create', compact('schedule'));
    }

    public function store(StoreRegistrationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Check if user already registered for this schedule
        $existingRegistration = UserTrainingRegistration::where('user_id', Auth::id())
            ->where('training_schedule_id', $validated['training_schedule_id'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->first();

        if ($existingRegistration) {
            return back()->with('error', 'Anda sudah terdaftar untuk jadwal pelatihan ini.');
        }

        // Upload payment proof
        $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        UserTrainingRegistration::create([
            'user_id' => Auth::id(),
            'training_schedule_id' => $validated['training_schedule_id'],
            'registration_date' => now(),
            'status' => 'pending',
            'payment_proof' => $paymentProofPath,
            'payment_status' => 'pending_verification',
            'payment_amount' => $validated['payment_amount'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('user.registrations.index')
            ->with('success', 'Pendaftaran berhasil! Bukti pembayaran Anda sedang diverifikasi.');
    }

    public function show(UserTrainingRegistration $registration): View
    {
        // Ensure user can only view their own registration
        if ($registration->user_id !== Auth::id()) {
            abort(403);
        }

        $registration->load(['trainingSchedule.training.category', 'verifiedBy']);

        return view('pages.user.registrations.show', compact('registration'));
    }

    public function cancel(UserTrainingRegistration $registration): RedirectResponse
    {
        // Ensure user can only cancel their own registration
        if ($registration->user_id !== Auth::id()) {
            abort(403);
        }

        if ($registration->status === 'confirmed') {
            return back()->with('error', 'Pendaftaran yang sudah dikonfirmasi tidak dapat dibatalkan.');
        }

        $registration->update([
            'status' => 'cancelled',
        ]);

        return back()->with('success', 'Pendaftaran berhasil dibatalkan.');
    }
}
