<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ProductRepository implements ProductRepositoryInterface
{

    private $model;

    public function __construct()
    {
        $this->model = new Product();
    }

    /**
     * List all Products
     * @param array $data 
     * @return array 
     */
    public function index(array $data = [])
    {
        try {
            $perPage = (int) (!empty($data['perPage'])) ? $data['perPage'] : 10;
            $list = [];

            if (!empty($data['all'])) {
                $list = $this->model->get();
            }

            if(!empty($data['ids'])) {
                $list = $this->model->whereIn('id', $data['ids'])->get();
            }

            if (!count($list)) {

                $list = $this->model;
                if (!empty($data['filter'])) {
                    $list = $list->orderBy($data['filter'], $data['order']);
                }

                $list = $list->paginate($perPage, ['*'], 'page', $data['page'] ?? null);
            }

            if ($list) {
                return [
                    'error' => 0,
                    'data' => $list
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error bringing all products.'
            ];
        } catch (\Exception $e) {

            Log::error('PRODUCT_REPOSITORY_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error bringing all products.'
            ];
        }
    }

    /**
     * Store a new Product
     * @param array $data 
     * @return array 
     */
    public function store(array $data)
    {
        try {

            $store = $this->model::create($data);

            if ($store) {
                return [
                    'error' => 0,
                    'data' => $store
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error registering product.'
            ];
        } catch (\Exception $e) {

            Log::error('PRODUCT_REPOSITORY_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error registering product.'
            ];
        }
    }

    /**
     * Update a Product
     * @param int $id Product id
     * @param array $data 
     * @return array 
     */
    public function update(int $id, array $data)
    {
        try {

            $update = $this->model::where('id', $id)->update($data);

            if ($update) {
                return [
                    'error' => 0,
                    'data' => $update
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error updating product.'
            ];
        } catch (\Exception $e) {

            Log::error('PRODUCT_REPOSITORY_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error updating product.'
            ];
        }
    }

    /**
     * Delete a Product
     * @param array $ids 
     * @return array 
     */
    public function delete(array $ids)
    {

        try {

            $delete = $this->model->whereIn('id', $ids)->delete();

            if ($delete) {
                return [
                    'error' => 0,
                    'data' => $delete
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error deleting the product.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error deleting the product.'
            ];
        }
    }

    /**
     * Get a Product
     * @param int $id
     * @return array 
     */
    public function show(int $id)
    {
        try {
            $product = $this->model::find($id);
            if ($product) {
                return [
                    'error' => 0,
                    'data' => $product
                ];
            }

            return [
                'error' => 1,
                'description' => 'Product not found.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error bringing product.'
            ];
        }
    }

    /**
     * Get some Products
     * @param array $id 
     * @return array 
     */
    public function showMultiple(array $id)
    {
        try {
            $product = $this->model::whereIn('id', $id)->get();
            if ($product) {
                return [
                    'error' => 0,
                    'data' => $product
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error bringing the products.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_SHOW_MULTIPLE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error bringing the products.'
            ];
        }
    }


    /**
     * Get the sum of the price of the products
     * @param array $data 
     * @return array 
     */
    public function sumPrice(array $data)
    {
        try {
            $itens = [];
            if (count($data)) {
                $itens['total'] = 0;
                $product = $this->model::whereIn('id', $data['ids'])->get();
                $count = 0;
                foreach ($product as $item) {
                    $currentPrice = $item->price;

                    if ($item->discount_status) {
                        $currentPrice -= ($currentPrice * ($item->discount / 100));
                    }


                    $finalPrice = 0;
                    $quantity = 0;
                    foreach ($data['items'] as $cart) {
                        if ($item->id == $cart['id']) {
                            $finalPrice = $currentPrice * ($cart['quantity'] ?? 1);
                            $quantity = $cart['quantity'];
                            continue;
                        }
                    }
                    $itens['itens'][] =  [
                        'id_product' => $item->id,
                        'price' => $finalPrice,
                        'quantity' => $quantity
                    ];
                    $itens['total'] += $finalPrice;
                }
            }

            if ($itens) {
                return [
                    'error' => 0,
                    'data' => $itens
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error adding prices.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_SUM_PRICE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error adding prices.'
            ];
        }
    }

    /**
     * Check if product Has a imgane name
     * @param int $id 
     * @return array 
     */
    public function checkIfProductHasImage(int $id)
    {
        try {

            $product = $this->model::where('id', $id)->whereNotNull('product_image')->first();

            if ($product) {
                return [
                    'error' => 0,
                    'data' => true
                ];
            }


            return [
                'error' => 1,
                'description' => 'Error checking.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_CHECK_IF_PRODUCTS_HAS_IMAGE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error checking.'
            ];
        }
    }


    /**
     * Get products by Ids
     * @param array $ids 
     * @return array 
     */
    public function getProductsByIds(array $ids)
    {
        try {

            $product = $this->model::whereIn('id', $ids)->get();

            if ($product) {
                return [
                    'error' => 0,
                    'data' => $product
                ];
            }


            return [
                'error' => 1,
                'description' => 'Error bringing products.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_GET_PRODUCTS_BY_IDS', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error bringing products.'
            ];
        }
    }
}
