<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification as NotificationFacade;

class SendBulkNotifications implements ShouldQueue
{
    use Batchable, Queueable;

    public $timeout = 300; // 5 minutes timeout

    public $tries = 3; // Retry 3 times if failed

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $roleNames,
        public Notification $notification,
        public int $chunkSize = 100
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Skip if batch is cancelled
        if ($this->batch()?->cancelled()) {
            return;
        }

        // Process users in chunks to avoid memory issues
        User::role($this->roleNames)
            ->select('id', 'email', 'first_name', 'last_name')
            ->chunk($this->chunkSize, function ($users) {
                // Send notifications to this chunk of users
                NotificationFacade::send($users, $this->notification);
            });
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('SendBulkNotifications failed', [
            'roles' => $this->roleNames,
            'notification' => get_class($this->notification),
            'error' => $exception->getMessage(),
        ]);
    }
}
