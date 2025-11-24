<?php

namespace App\Notifications;

use App\Models\Refund;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RefundProcessed extends Notification
{
    use Queueable;

    public function __construct(public Refund $refund) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $registration = $this->refund->registration;

        return (new MailMessage)
            ->subject('Refund Pendaftaran Pelatihan Telah Diproses')
            ->greeting('Halo '.$notifiable->name.',')
            ->line('Refund untuk pendaftaran pelatihan '.$registration->trainingSchedule->training->name.' telah diproses.')
            ->line('Jumlah Refund: Rp '.number_format($this->refund->refund_amount, 0, ',', '.'))
            ->line('Metode Refund: '.ucfirst(str_replace('_', ' ', $this->refund->refund_method)))
            ->line('Status: '.ucfirst($this->refund->refund_status))
            ->when($this->refund->refund_notes, function ($mail) {
                return $mail->line('Catatan: '.$this->refund->refund_notes);
            })
            ->action('Lihat Detail', route('user.registrations.show', $registration))
            ->line('Jika ada pertanyaan mengenai refund ini, silakan hubungi kami.');
    }

    public function toArray(object $notifiable): array
    {
        $registration = $this->refund->registration;

        return [
            'refund_id' => $this->refund->id,
            'registration_id' => $registration->id,
            'training_name' => $registration->trainingSchedule->training->name,
            'refund_amount' => $this->refund->refund_amount,
            'refund_method' => $this->refund->refund_method,
            'refund_status' => $this->refund->refund_status,
            'message' => 'Refund pendaftaran pelatihan Anda telah diproses',
        ];
    }
}
