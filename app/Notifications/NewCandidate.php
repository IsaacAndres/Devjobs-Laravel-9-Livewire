<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCandidate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($idVacancy, $nameVacancy, $userId)
    {
        $this->idVacancy    = $idVacancy;
        $this->nameVacancy  = $nameVacancy;
        $this->userId       = $userId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('notifications');

        return (new MailMessage)
                    ->subject('Nuevo cadidato en ' . $this->nameVacancy)
                    ->line('Has recibido un nuevo cadidato en la vacante: ' . $this->nameVacancy)
                    ->action('Ver notificaciones', $url)
                    ->line('Gracias por utilizar DevJobs');
    }

    public function toDatabase($notifiable)
    {
        return [
            'idVacancy'   => $this->idVacancy,
            'nameVacancy' => $this->nameVacancy,
            'userId'      => $this->userId,
        ];
    }
}
