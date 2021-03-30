<?php

namespace App\Repositories;

use App\Models\OrderProduct;
use App\Repositories\Interfaces\OrderProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderProductRepository implements OrderProductRepositoryInterface
{

    private $model;

    public function __construct()
    {
        $this->model = new OrderProduct();
    }

    public function index() {
        
    }

    /**
     * Create a orderProduct
     * @param array $data orderProduct info
     * @return array A array with error and data or error with description error
     */
    public function store(array $data) {
        try {
            DB::beginTransaction();
            $orderProduct = $this->model::create($data);
            DB::commit();
            if($orderProduct) {
                return [
                    'error' => 0,
                    'data' => $orderProduct
                ];
            }

            return [
                'error' => 1,
                'description' => 'Erro cadastrar os produtos no pedido.'
            ];

        } catch(\Exception $e) {

            Log::error('ORDER_PRODUCT_REPOSITORY_STORE', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Erro cadastrar os produtos no pedido.'
            ];
        }
    }

    public function update(int $id, array $data) {
        
    }

    public function delete(int $id) {
        
    }
    
    public function show(int $id) {
        
    }

    /**
     * Get the Order related to OrderProduct
     * @param int $id Order id
     * @return array A array with error and data or error with description error
     */
    public function showOrderFromOrderProduct(int $id) {
        try {
            $order = $this->model::where('id_order', $id)->first()->order()->get();

            if($order) {
                return [
                    'error' => 0,
                    'data' => $order
                ];
            }

            return [
                'error' => 1,
                'description' => 'Erro ao trazer o pedido.'
            ];

        } catch(\Exception $e) {

            Log::error('ORDER_PRODUCT_REPOSITORY_SHOW_ORDER_FROM_ORDER_PRODUCT', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Erro ao trazer o pedido.'
            ];
        }
    }

    /**
     * Traz o Produto relacionado a PedidoProduto
     * @param int $id Product id
     * @return array A array with error and data or error with description error
     */
    public function showProductFromOrderProduct(int $id) {
        try {
            $product = $this->model::where('id_product', $id)->first()->product()->get();
            
            if($product) {
                return [
                    'error' => 0,
                    'data' => $product
                ];
            } 

            return [
                'error' => 1,
                'description' => 'Erro ao trazer o produto.'
            ];

        } catch(\Exception $e) {

            Log::error('ORDER_PRODUCT_REPOSITORY_SHOW_PRODUCT_FROM_ORDER_PRODUCT', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Erro ao trazer o produto.'
            ];
        }
    }

    /**
     * Traz o Produto relacionado a PedidoProduto
     * @param array $id Product id array
     * @return array A array with error and data or error with description error
     */
    public function showProductFromOrderProductMultiple(array $id) {
        try {
            $product = $this->model::whereIn('id_product', $id)->first()->product()->get();
            
            if($product) {
                return [
                    'error' => 0,
                    'data' => $product
                ];
            } 

            return [
                'error' => 1,
                'description' => 'Erro ao trazer o produto.'
            ];

        } catch(\Exception $e) {

            Log::error('ORDER_PRODUCT_REPOSITORY_SHOW_PRODUCT_FROM_ORDER_PRODUCT', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Erro ao trazer o produto.'
            ];
        }
    }
}
