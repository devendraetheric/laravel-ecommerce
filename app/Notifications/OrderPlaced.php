<?php

namespace App\Notifications;

use App\Models\Order;
use App\Settings\GeneralSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlaced extends Notification
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
            ->line('Total: $' . $this->order->grand_total)
            ->action('View Order', route('account.orders.show', $this->order))
            ->line('Thank you for shopping with us!')
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
