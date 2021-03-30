<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Carbon\Carbon;

class OrderProductObserver
{
    /**
     * Handle the OrderProduct "created" event.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function created(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the OrderProduct "updated" event.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function updated(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the OrderProduct "deleted" event.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function deleted(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the OrderProduct "restored" event.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function restored(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the OrderProduct "force deleted" event.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function forceDeleted(OrderProduct $orderProduct)
    {
        //
    }


    public function creating(OrderProduct $orderProduct)
    {
        
        // $lastOrderId = 1;

        // $last = Order::latest('id')->first();

        // if(!empty($last)){
        //     $lastOrderId = $last->id + 1;
        // }
        // $price_product = Product::where('id', $orderProduct->id_product)->first()->price;
        // $total_price = $price_product * $orderProduct->quantity;
        // $order = Order::create([
        //     'n_order' => '#' . str_pad($lastOrderId, 8, "0", STR_PAD_LEFT),
        //     'id_user' => User::all()->random()->id,
        //     'total_price' => $total_price,
        //     'status' => '0',
        //     'dt_order' => now()
        // ]);

        // $orderProduct->id_order = $order->id;
    }

}
