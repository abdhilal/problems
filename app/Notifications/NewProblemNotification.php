<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProblemNotification extends Notification
{
    use Queueable;

 
    protected $problem;
    public function __construct($problem)
    {
        $this->problem = $problem;
    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray(object $notifiable): array
    {
        return [
            'message' => ' تم نشر مشكلة جديدة قد تهمك : ' . $this->problem->title,

            'problem_id' => $this->problem->id
        ];
    }
}
