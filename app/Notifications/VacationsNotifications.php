<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class VacationsNotifications extends Notification
{
    use Queueable;
    public $vacation;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vacation)
    {
        $this->vacation = $vacation;
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'user_id' =>$this->vacation->getUser->name,
            'id'=>$this->vacation->id,
            'description'=>$this->vacation->description,
            'job_id' =>$this->vacation->getJob->name,
            'request_date'=>$this->vacation->request_date,
            'link' => URL::to('vacationrequest/'.$this->vacation->id.'/edit'),
        ];
    }
}