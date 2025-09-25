<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlaced extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected $order
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
            ->subject('Order Confirmation')
            ->greeting('Hello ' . $this->order->user->name . '!')
            ->line('Thank you for your order.')
            ->line('Order #: ' . $this->order->order_number)
            ->line('Total: ' . get_currency_symbol() . $this->order->grand_total)
            ->action('View Order', route('account.orders.show', $this->order))
            ->line('Thank you for shopping with us!')
            ->line('')
            ->salutation("Best Regards, \n\n **" . setting('general.app_name') . "**");
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
