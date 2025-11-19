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
        $chunkSize = 1000; // Delete in chunks to avoid locking

        $this->info("Deleting notifications older than {$days} days...");

        $cutoffDate = now()->subDays($days);
        $totalDeleted = 0;

        // Delete in chunks to avoid database locks and memory issues
        do {
            $deletedCount = DB::table('notifications')
                ->where('created_at', '<', $cutoffDate)
                ->limit($chunkSize)
                ->delete();

            $totalDeleted += $deletedCount;

            if ($deletedCount > 0) {
                $this->info("Deleted {$deletedCount} notifications... (Total: {$totalDeleted})");

                // Brief pause to avoid overwhelming the database
                usleep(100000); // 100ms pause
            }
        } while ($deletedCount > 0);

        if ($totalDeleted > 0) {
            $this->info("✓ Successfully deleted {$totalDeleted} old notification(s).");
        } else {
            $this->info('No old notifications to delete.');
        }

        return Command::SUCCESS;
    }
}
