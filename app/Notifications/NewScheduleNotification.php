<?php

namespace App\Notifications;

use App\Models\TrainingSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewScheduleNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public TrainingSchedule $schedule) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'new_schedule',
            'schedule_id' => $this->schedule->id,
            'training_id' => $this->schedule->training_id,
            'title' => 'Jadwal Baru: '.$this->schedule->training->title,
            'message' => 'Jadwal training baru "'.$this->schedule->training->title.'" telah dibuka.',
            'training_title' => $this->schedule->training->title,
            'start_date' => $this->schedule->start_date,
            'end_date' => $this->schedule->end_date,
            'location' => $this->schedule->location,
            'method' => $this->schedule->method,
            'available_slots' => $this->schedule->available_slots,
            'url' => route('admin.schedules.show', $this->schedule->id),
            'icon' => 'calendar',
            'color' => 'green',
        ];
    }
}
