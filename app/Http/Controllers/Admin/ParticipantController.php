<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

                // Filter by role
        if ($request->filled('role') && $request->role !== 'all') {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        // Status filter (based on email_verified)
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereNotNull('email_verified_at');
            } elseif ($request->status === 'inactive') {
                $query->whereNull('email_verified_at');
            }
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortBy, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 10);
        $participants = $query->paginate($perPage)->withQueryString();

        // Calculate statistics
        $stats = [
            'total' => User::count(),
            'active' => User::whereNotNull('email_verified_at')->count(),
            'corporate' => User::role('corporate')->count(),
            'new' => User::where('created_at', '>=', now()->subDays(30))->count(),
        ];

        return view('pages.admin.participants.index', compact(
            'participants',
            'stats'
        ));
    }

    public function show(User $user)
    {
        return view('pages.admin.participants.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('pages.admin.participants.edit', compact('user'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.participants.index')
            ->with('success', 'Peserta berhasil dihapus');
    }

    public function bulkDelete(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => 'required|json',
        ]);

        $ids = json_decode($request->ids);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada peserta yang dipilih');
        }

        User::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', count($ids).' peserta berhasil dihapus');
    }

    public function bulkUpdateStatus(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => 'required|json',
            'status' => 'required|in:active,inactive',
        ]);

        $ids = json_decode($request->ids);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada peserta yang dipilih');
        }

        if ($request->status === 'active') {
            User::whereIn('id', $ids)->update([
                'email_verified_at' => now(),
            ]);
        } else {
            User::whereIn('id', $ids)->update([
                'email_verified_at' => null,
            ]);
        }

        $statusText = $request->status === 'active' ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()->with('success', count($ids).' peserta berhasil '.$statusText);
    }
}
