<?php

namespace App\Notifications;

use App\Settings\GeneralSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected $contactQuery
    ) {
        // 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Contact Created')
            ->greeting('Hello Admin')
            ->line('A new contact query been submitted to the contact form.')
            ->line('Name    : ' . $this->contactQuery->name)
            ->line('Email   : ' . $this->contactQuery->email)
            ->line('Phone   : ' . $this->contactQuery->phone)
            ->line('Subject : ' . $this->contactQuery->subject)
            ->line('Message : ' . $this->contactQuery->message)

            ->line('Please review the submission at your earliest convenience.')
            ->salutation("Best Regards, \n " . setting('general.app_name'));
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
