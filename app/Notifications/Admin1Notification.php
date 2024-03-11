<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class Admin1Notification extends Notification implements ShouldQueue
{
    use Queueable;
    public $request_detail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request_detail)
    {
        $this->request_detail = $request_detail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                            ->from($this->request_detail['from_email'], $this->request_detail['from_name'])
                            ->subject($this->request_detail['subject'])
                            ->greeting($this->request_detail['greeting'])
                            ->line(new HtmlString($this->request_detail['message']))
                            ->line($this->request_detail['reply_to'])
                            ->line('Thank you!');
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
}
