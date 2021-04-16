<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrdemExecutada extends Notification
{
    use Queueable;
    private $detalhes;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($detalhes)
    {
        //
        $this->detalhes = $detalhes;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
          ->greeting($this->detalhes['greeting'])
          ->line($this->detalhes['body'])
          ->line($this->detalhes['thanks']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
    public function toDatabase($notifiable)
    {
        return [
           'body' => $this->detalhes['body'],
           'greeting' => $this->detalhes['greeting'],
           'subject' => $this->detalhes['subject']
        ];
    }
}

