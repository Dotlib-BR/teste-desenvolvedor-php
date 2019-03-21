<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\Session;

class OrderObserver
{
    /**
     * Handle the order "creating" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    
    /**
     * Handle the order "saving" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function saving(Order $order)
    {
        if (! $order->date_order) {
            $order->date_order = date('Y-m-d');
        }
    }

    /**
     * Handle the order "saved" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function saved(Order $order)
    {
        Session::remove('cart');
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
