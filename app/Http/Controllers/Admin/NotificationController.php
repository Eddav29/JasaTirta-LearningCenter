<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Display a listing of notifications.
     */
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $notifications = $user
            ->notifications()
            ->paginate(15);

        $unreadCount = $user->unreadNotifications()->count();

        return view('pages.admin.notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * Get notifications as JSON (for AJAX requests).
     */
    public function getNotifications(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $limit = $request->input('limit', 10);

        $notifications = $user->notifications()
            ->take($limit)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->data['type'] ?? 'info',
                    'title' => $notification->data['title'] ?? '',
                    'message' => $notification->data['message'] ?? '',
                    'icon' => $notification->data['icon'] ?? 'bell',
                    'color' => $notification->data['color'] ?? 'gray',
                    'url' => $notification->data['url'] ?? '#',
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at->diffForHumans(),
                    'created_at_full' => $notification->created_at->format('d M Y H:i'),
                ];
            });

        $unreadCount = $user->unreadNotifications()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(string $id): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $notification = $user
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read',
        ]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->unreadNotifications->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read',
        ]);
    }

    /**
     * Remove the specified notification.
     */
    public function destroy(string $id): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $notification = $user
            ->notifications()
            ->findOrFail($id);

        $notification->delete();

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'Notification deleted successfully');
    }

    /**
     * Delete a notification via AJAX.
     */
    public function delete(string $id): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $notification = $user
            ->notifications()
            ->findOrFail($id);

        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notification deleted successfully',
        ]);
    }
}
