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
     * @param array $data Filter info
     * @return array A array with error and data or error with description error
     */
    public function index(array $data = [])
    {
        try {
            $perPage = (int) (!empty($data['perPage'])) ? $data['perPage'] : 20;
            $list = [];

            if (!empty($data['all'])) {
                $list = $this->model->get();
            }

            if (!count($list)) {

                $list = $this->model;
                if (!empty($data['filter'])) {
                    $list = $list->orderBy($data['filter'], $data['order']);
                    // dd($list->toSql());
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
                'description' => 'Erro ao Trazer todos os produtos.'
            ];
        } catch (\Exception $e) {

            Log::error('PRODUCT_REPOSITORY_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao Trazer todos os produtos.'
            ];
        }
    }

    /**
     * Store a new Product
     * @param array $data Product info
     * @return array A array with error and data or error with description error
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
                'description' => 'Erro ao cadastrar produto.'
            ];
        } catch (\Exception $e) {

            Log::error('PRODUCT_REPOSITORY_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao cadastrar produto.'
            ];
        }
    }

    /**
     * Update a Product
     * @param int $id Product id
     * @param array $data Product info
     * @return array A array with error and data or error with description error
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
                'description' => 'Erro ao atualizar produto.'
            ];
        } catch (\Exception $e) {

            Log::error('PRODUCT_REPOSITORY_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao atualizar produto.'
            ];
        }
    }

    /**
     * Delete a Product
     * @param int $id Product id
     * @return array A array with error and data or error with description error
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
                'description' => 'Erro ao deletar produto.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao deletar produto.'
            ];
        }
    }

    /**
     * Get a Product
     * @param array $id Product id
     * @return array A array with error and data or error with description error
     */
    public function show(array $id)
    {
        try {
            $product = $this->model->whereIn('id', $id)->get();
            if ($product) {
                return [
                    'error' => 0,
                    'data' => $product
                ];
            }

            return [
                'error' => 1,
                'description' => 'Erro ao trazer produto.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao trazer produto.'
            ];
        }
    }

    /**
     * Get some Products
     * @param array $id Product id array
     * @return array A array with error and data or error with description error
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
                'description' => 'Erro ao trazer os produtos.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_SHOW_MULTIPLE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao trazer os produtos.'
            ];
        }
    }

    /**
     * List Products with pagination
     * @param int $perPage Products per page
     * @return array A array with error and data or error with description error
     */
    public function indexPage(int $perPage)
    {
        try {
            $data = $this->model->paginate($perPage);
            if ($data) {
                return [
                    'error' => 0,
                    'data' => $data
                ];
            }

            return [
                'error' => 1,
                'description' => 'Erro ao pegar os produtos.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_INDEX_PAGE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao pegar os produtos.'
            ];
        }
    }


    /**
     * Get the sum of the price of the products
     * @param array $data Array with id and quantity
     * @return array A array with error and data or error with description error
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
                'description' => 'Erro ao somar os preços.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_SUM_PRICE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao somar os preços.'
            ];
        }
    }

    /**
     * Check if product Has a imgane name
     * @param int $id Product id
     * @return array A array with error and data or error with description error
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
                'description' => 'Erro ao checar.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_REPOSITORY_CHECK_IF_PRODUCTS_HAS_IMAGE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao checar.'
            ];
        }
    }


    /**
     * Get products by Ids
     * @param array $ids ProductsIds
     * @return array A array with error and data or error with description error
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
