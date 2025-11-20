<?php

namespace App\Observers;

use App\Jobs\SendBulkNotifications;
use App\Models\Training;
use App\Notifications\NewTrainingNotification;

class TrainingObserver
{
    /**
     * Handle the Training "created" event.
     */
    public function created(Training $training): void
    {
        // Dispatch job to send notifications in chunks
        // This prevents memory issues and server overload with many users
        SendBulkNotifications::dispatch(
            ['user', 'participant', 'admin', 'super-admin'],
            new NewTrainingNotification($training),
            100 // Process 100 users per chunk
        )->onQueue('notifications');
    }
}
