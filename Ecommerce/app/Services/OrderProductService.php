<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Repositories\OrderProductRepository;
use Illuminate\Support\Facades\DB;

class OrderProductService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new OrderProductRepository();
    }

    /**
     * Get the Order related to OrderProduct
     * @param int $id Order id
     * @return array A array with error and data or error with description error
     */
    public function showOrderFromOrderProduct($id)
    {
        try {
            $order = $this->repository->showOrderFromOrderProduct($id);

            if ($order['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => $order['data']
                ];
            }

            return [
                'error' => 1,
                'description' => $order['description']
            ];
        } catch (\Exception $e) {

            Log::error('ORDER_PRODUCT_SERVICE_SHOW_ORDER_FROM_ORDER_PRODUCT', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Error bringing order.'
            ];
        }
    }
}
