<?php

namespace App\Notifications;

use App\Models\UserTrainingRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationRejected extends Notification
{
    use Queueable;

    public function __construct(public UserTrainingRegistration $registration) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pendaftaran Pelatihan Ditolak')
            ->greeting('Halo '.$notifiable->name.',')
            ->line('Mohon maaf, pendaftaran Anda untuk pelatihan '.$this->registration->trainingSchedule->training->name.' tidak dapat disetujui.')
            ->line('Alasan: '.$this->registration->rejected_reason)
            ->line('Anda dapat mendaftar ulang dengan bukti pembayaran yang valid.')
            ->action('Lihat Detail', route('user.registrations.show', $this->registration))
            ->line('Jika ada pertanyaan, silakan hubungi kami.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'registration_id' => $this->registration->id,
            'training_name' => $this->registration->trainingSchedule->training->name,
            'message' => 'Pendaftaran pelatihan Anda ditolak',
            'rejected_reason' => $this->registration->rejected_reason,
        ];
    }
}
