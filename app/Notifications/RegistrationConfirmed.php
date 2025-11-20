<?php

namespace App\Notifications;

use App\Models\UserTrainingRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationConfirmed extends Notification
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
            ->subject('Pendaftaran Pelatihan Dikonfirmasi')
            ->greeting('Halo '.$notifiable->name.',')
            ->line('Pendaftaran Anda untuk pelatihan '.$this->registration->trainingSchedule->training->name.' telah dikonfirmasi!')
            ->line('Pembayaran Anda telah diverifikasi dan pendaftaran Anda telah disetujui.')
            ->line('Tanggal Mulai: '.\Carbon\Carbon::parse($this->registration->trainingSchedule->start_date)->format('d M Y'))
            ->action('Lihat Detail', route('user.registrations.show', $this->registration))
            ->line('Terima kasih telah mendaftar!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'registration_id' => $this->registration->id,
            'training_name' => $this->registration->trainingSchedule->training->name,
            'message' => 'Pendaftaran pelatihan Anda telah dikonfirmasi',
        ];
    }
}
