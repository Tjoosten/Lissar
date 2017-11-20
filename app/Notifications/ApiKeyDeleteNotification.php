<?php

namespace App\Notifications;

use App\User;
use App\ApiKeys;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ApiKeyDeleteNotification extends Notification
{
    use Queueable;

    public $dbKey;  /** @var ApiKeys $dbKey */
    public $user;   /** @var User    $user  */

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ApiKeys $dbKey, User $user)
    {
        $this->dbKey  = $dbKey; 
        $this->user   = $user;
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
        return (new MailMessage)
            ->subject('One of your invoices has been paid!')
            ->markdown('notifications.mail.delete', ['user' => $this->user, 'dbKey' => $this->dbKey]);
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
            'test' => 'key'
        ];
    }
}
