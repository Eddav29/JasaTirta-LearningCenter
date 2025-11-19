<?php

namespace App\Observers;

use App\Models\Training;
use App\Models\User;
use App\Notifications\NewTrainingNotification;
use Illuminate\Support\Facades\Notification;

class TrainingObserver
{
    /**
     * Handle the Training "created" event.
     */
    public function created(Training $training): void
    {
        // Get all users with 'user' or 'participant' role
        $users = User::role(['user', 'participant'])->get();

        // Also notify admins
        $admins = User::role(['admin', 'super-admin'])->get();

        // Merge both collections
        $recipients = $users->merge($admins);

        // Send notification to all recipients
        if ($recipients->isNotEmpty()) {
            Notification::send($recipients, new NewTrainingNotification($training));
        }
    }
}
