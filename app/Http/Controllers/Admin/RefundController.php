<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\UserTrainingRegistration;
use App\Notifications\RefundProcessed;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RefundController extends Controller
{
    public function create(UserTrainingRegistration $registration): View|RedirectResponse
    {
        // Check if refund already exists
        if ($registration->refund) {
            return redirect()
                ->route('admin.registrations.show', $registration)
                ->with('error', 'Refund sudah dibuat untuk pendaftaran ini.');
        }

        // Check if registration is eligible for refund
        if ($registration->status !== 'cancelled' || $registration->payment_status !== 'refunded') {
            return redirect()
                ->route('admin.registrations.show', $registration)
                ->with('error', 'Pendaftaran tidak eligible untuk refund.');
        }

        $registration->load(['user', 'trainingSchedule.training']);

        return view('pages.admin.refunds.create', compact('registration'));
    }

    public function store(Request $request, UserTrainingRegistration $registration): RedirectResponse
    {
        $validated = $request->validate([
            'refund_amount' => 'required|numeric|min:0|max:'.$registration->payment_amount,
            'refund_method' => 'required|in:bank_transfer,cash,ewallet,other',
            'refund_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'refund_notes' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();

        try {
            // Upload refund proof if provided
            if ($request->hasFile('refund_proof')) {
                $validated['refund_proof'] = $request->file('refund_proof')->store('refund-proofs', 'public');
            }

            // Create refund record
            $refund = $registration->refund()->create([
                'refund_amount' => $validated['refund_amount'],
                'refund_method' => $validated['refund_method'],
                'refund_status' => 'completed',
                'refund_proof' => $validated['refund_proof'] ?? null,
                'refund_notes' => $validated['refund_notes'] ?? null,
                'rejection_reason' => $registration->rejected_reason,
                'processed_by' => Auth::id(),
                'processed_at' => now(),
            ]);

            // Send notification to user
            $registration->user->notify(new RefundProcessed($refund));

            DB::commit();

            return redirect()
                ->route('admin.registrations.show', $registration)
                ->with('success', 'Refund berhasil diproses.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Delete uploaded file if exists
            if (isset($validated['refund_proof']) && Storage::disk('public')->exists($validated['refund_proof'])) {
                Storage::disk('public')->delete($validated['refund_proof']);
            }

            return back()
                ->withInput()
                ->with('error', 'Gagal memproses refund: '.$e->getMessage());
        }
    }

    public function show(Refund $refund): View
    {
        $refund->load(['registration.user', 'registration.trainingSchedule.training', 'processedBy']);

        return view('pages.admin.refunds.show', compact('refund'));
    }

    public function updateStatus(Request $request, Refund $refund): RedirectResponse
    {
        $validated = $request->validate([
            'refund_status' => 'required|in:pending,processing,completed,failed',
            'refund_notes' => 'nullable|string|max:1000',
        ]);

        $refund->update([
            'refund_status' => $validated['refund_status'],
            'refund_notes' => $validated['refund_notes'] ?? $refund->refund_notes,
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        // Send notification if status is completed
        if ($validated['refund_status'] === 'completed') {
            $refund->registration->user->notify(new RefundProcessed($refund));
        }

        return back()->with('success', 'Status refund berhasil diperbarui.');
    }
}
