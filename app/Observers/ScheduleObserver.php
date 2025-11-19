<?php

namespace App\Observers;

use App\Jobs\SendBulkNotifications;
use App\Models\TrainingSchedule;
use App\Notifications\NewScheduleNotification;

class ScheduleObserver
{
    /**
     * Handle the TrainingSchedule "created" event.
     */
    public function created(TrainingSchedule $schedule): void
    {
        // Dispatch job to send notifications in chunks
        // This prevents memory issues and server overload with many users
        SendBulkNotifications::dispatch(
            ['user', 'participant', 'admin', 'super-admin'],
            new NewScheduleNotification($schedule),
            100 // Process 100 users per chunk
        )->onQueue('notifications');
    }
}
