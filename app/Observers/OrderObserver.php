<?php

namespace App\Observers;

use App\Models\Order;
use App\Notifications\OrderPlaced;
use App\Settings\PrefixSetting;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $prefix = app(PrefixSetting::class);
        $prefix->order_sequence++;
        $prefix->save();

        $order->user->notify(new OrderPlaced($order));
    }


    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
