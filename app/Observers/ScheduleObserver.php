<?php

namespace App\Observers;

use App\Models\TrainingSchedule;
use App\Models\User;
use App\Notifications\NewScheduleNotification;
use Illuminate\Support\Facades\Notification;

class ScheduleObserver
{
    /**
     * Handle the TrainingSchedule "created" event.
     */
    public function created(TrainingSchedule $schedule): void
    {
        // Get all users with 'user' or 'participant' role
        $users = User::role(['user', 'participant'])->get();

        // Also notify admins
        $admins = User::role(['admin', 'super-admin'])->get();

        // Merge both collections
        $recipients = $users->merge($admins);

        // Send notification to all recipients
        if ($recipients->isNotEmpty()) {
            Notification::send($recipients, new NewScheduleNotification($schedule));
        }
    }
}
