<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientObserver
{
    /**
     * Handle the client "created" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function created(Client $client)
    {
        //
    }

    /**
     * Handle the client "updated" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function updated(Client $client)
    {
        //
    }

    /**
     * Handle the client "deleted" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function deleted(Client $client)
    {

        try {
            if (count($client->purchases) > 0) {

                foreach ($client->purchases as $purchase) {//preciso percorrer os pedidos de compras para apagar

                    if (count($purchase->orders) > 0) {

                        foreach ($purchase->orders as $order) {
                            $order->delete();
                        }

                        $purchase->delete();
                    }
                }
            }

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }
        }
    }

    /**
     * Handle the client "restored" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function restored(Client $client)
    {
        //
    }

    /**
     * Handle the client "force deleted" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        //
    }
}
