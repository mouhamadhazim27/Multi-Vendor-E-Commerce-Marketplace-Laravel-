<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $store;
    public function __construct($store)
    {
        $this->store = $store;
    }
   

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
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable)
    {
       return [
            'store_id' => $this->store->id,
            'message' => 'Your store "' . $this->store->store_name . '" has been approved!',
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
