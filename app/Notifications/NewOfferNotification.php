<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOfferNotification extends Notification
{
    use Queueable;


    protected $problem;
    protected $message;
    public function __construct($problem,$message)
    {
        $this->problem = $problem;
        $this->message=$message;

    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message,
            'problem_id' => $this->problem->id
        ];
    }
}
