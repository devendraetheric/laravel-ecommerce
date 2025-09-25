<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected $order)
    {
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
        $customer = $this->order->user;

        $message = (new MailMessage)
            ->subject('New Order Alert - #' . $this->order->order_number)
            ->greeting('Hello Admin,')
            ->line('A new order has been received.')
            ->line('')
            ->line('**📦 Order Information:**')
            ->line('Order Number: #' . $this->order->order_number)
            ->line('Order Date: ' . $this->order->order_date->format(setting('general.date_format') . ' ' . setting('general.time_format')))
            ->line('')
            ->line('**👤 Customer Information:**')
            ->line('Name: ' . $customer->name)
            ->line('Email: ' . $customer->email)
            ->line('Phone: ' . $customer->phone);

        // Add shipping address
        if ($address = $this->order->address) {
            $message->line('')
                ->line('**📍 Shipping Address:**')
                ->line('Contact: ' . $address->contact_name)
                ->line("{$address->address_line_1}, $address->address_line_2")
                ->line("{$address->city}, {$address->state->name}, {$address->zip_code} - {$address->country->name} ")
                ->line('Phone: ' . $address->phone);
        }

        // Add order items with SKU
        $message->line('')
            ->line('**🛍️ Ordered Products:**');
        foreach ($this->order->items as $item) {
            $message->line(sprintf(
                "%s (SKU: %s)",
                $item->product->name,
                $item->product->sku
            ))
                ->line(sprintf(
                    "  Quantity: %d | Unit Price: %s | Total: %s",
                    $item->quantity,
                    get_currency_symbol() . $item->price,
                    get_currency_symbol() . $item->total
                ));
        }

        // Add financial summary
        $message->line('')
            ->line('**💰 Financial Summary:**')
            ->line('Subtotal: ' . get_currency_symbol() . $this->order->sub_total);

        // Add tax breakdown
        foreach ($this->order->tax_breakdown as $tax) {
            $message->line("{$tax['name']} ({$tax['rate']}%): " . get_currency_symbol() . $tax['total_amount']);
        }

        $message->line('Delivery Charge: ' . get_currency_symbol() . $this->order->delivery_charge)
            ->line('Grand Total: ' . get_currency_symbol() . $this->order->grand_total)
            ->line('')
            ->line('**💳 Payment Details:**')
            ->line('Method: ' . ucfirst($this->order->payment_method))
            ->line('Status: ' . $this->order->payment_status->value);

        if ($this->order->notes) {
            $message->line('')
                ->line('**📝 Customer Notes:**')
                ->line($this->order->notes);
        }

        $message->action('View Order in Admin Panel', route('admin.orders.show', $this->order))
            ->line('')
            ->line('This is an automated notification. Please check the admin panel for more details.')
            ->line('')
            ->salutation("Best Regards, \n\n **" . setting('general.app_name') . "**");

        return $message;
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
