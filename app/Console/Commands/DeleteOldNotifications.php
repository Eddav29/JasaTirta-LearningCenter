<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteOldNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:cleanup {--days=30 : Number of days to keep notifications}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete notifications older than specified days (default: 30 days)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $days = $this->option('days');

        $this->info("Deleting notifications older than {$days} days...");

        $deletedCount = DB::table('notifications')
            ->where('created_at', '<', now()->subDays($days))
            ->delete();

        if ($deletedCount > 0) {
            $this->info("Successfully deleted {$deletedCount} old notification(s).");
        } else {
            $this->info('No old notifications to delete.');
        }

        return Command::SUCCESS;
    }
}
