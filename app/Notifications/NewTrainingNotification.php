<?php

namespace App\Notifications;

use App\Models\Training;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewTrainingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Training $training) {}

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
            'type' => 'new_training',
            'training_id' => $this->training->id,
            'title' => 'Training Baru: '.$this->training->title,
            'message' => 'Training baru "'.$this->training->title.'" telah ditambahkan.',
            'training_title' => $this->training->title,
            'category' => $this->training->category->name ?? null,
            'instructor' => $this->training->instructor->name ?? null,
            'duration' => $this->training->duration,
            'price' => $this->training->price,
            'url' => route('admin.trainings.show', $this->training->id),
            'icon' => 'book-open',
            'color' => 'blue',
        ];
    }
}
