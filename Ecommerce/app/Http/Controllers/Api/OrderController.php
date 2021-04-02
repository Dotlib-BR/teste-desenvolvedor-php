<?php

namespace App\Http\Controllers\Api;

use App\Facades\OrderFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        try {
            $filter = $request->only(['filter', 'perPage', 'page']);

            $orders = OrderFacade::index($filter);

            if (!empty($orders['data']->onEachSide)) {
                $orders['data'] = $orders['data']->items();
            }

            if ($orders['error'] === 0) {
                return response([
                    'error' => 0,
                    'data' => $orders['data']
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Error bringing orders'
            ]);
        } catch (\Exception $e) {
            Log::error('ORDER_API_CONTROLLER_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }

    /**
     * Get order
     * @param int $id 
     * @return @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $order = OrderFacade::show($id);
            if ($order['error'] === 0) {
                return response([
                    'error' => 0,
                    'data' => $order['data']
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Order not found.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('ORDER_API_CONTROLLER_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }

    /**
     * Store order
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $orderInfo = $request->all();

            $stored = OrderFacade::store($orderInfo);

            if ($stored['error'] === 0) {
                return response([
                    'error' => 0,
                    'description' => 'Order made successfully.'
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Error creating order.'
            ]);
        } catch (\Exception $e) {
            Log::error('ORDER_API_CONTROLLER_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }

    /**
     * Delete specific order
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $id = null)
    {
        try {
            $orderInfo = $request->all();

            $stored = OrderFacade::delete($id ?? $orderInfo);

            if ($stored['error'] === 0) {
                return response([
                    'error' => 0,
                    'description' => 'Order successfully deleted.'
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Error deleting order.'
            ]);
        } catch (\Exception $e) {
            Log::error('ORDER_API_CONTROLLER_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }

    /**
     * Update specific order
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        try {
            $status = $request->only('status');

            $updated = OrderFacade::update($id, $status);

            if ($updated['error'] === 0) {
                return response([
                    'error' => 0,
                    'description' => 'Order Updated successfully.'
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Error updating order.'
            ]);
        } catch (\Exception $e) {
            Log::error('ORDER_API_CONTROLLER_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }
}
