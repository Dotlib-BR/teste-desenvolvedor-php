<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;

class OrderService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new OrderRepository();
    }

    /**
     * List all Order with per page or not
     * @param int $perPage Itens per page
     * @return array
     */
    public function index(array $filter = [])
    {

        try {
            $data = [];

            if (!empty($filter['filter'])) {

                $filter['order'] = 'DESC';



                if ($filter['filter'] === "older" || $filter['filter'] === "low") {
                    $filter['order'] = 'ASC';
                }

                $filter['filter'] = ($filter['filter'] === 'high' || $filter['filter'] == 'low') ? 'total_price' : $filter['filter'];

                $filter['filter'] = ($filter['filter'] === 'newer' || $filter['filter'] === 'older') ? 'dt_order' : $filter['filter'];
            }

            $data = $this->repository->index($filter ?? []);


            if ($data) {
                return [
                    'error' => 0,
                    'data' => $data['data']
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error when bringing the products.'
            ];
        } catch (\Exception $e) {
            Log::error('ORDER_SERVICE_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error when bringing the products.'
            ];
        }
    }

    /**
     * Show order with orderProducts
     * @param int $id Order id
     * @return array
     */
    public function show(int $id)
    {
        try {

            $data = $this->repository->show($id);

            if ($data['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => $data['data']
                ];
            }

            return [
                'error' => 1,
                'description' => $data['description']
            ];
        } catch (\Exception $e) {
            Log::error('ORDER_SERVICE_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error bringing order.'
            ];
        }
    }
    /**
     * Store Order and Store orderProduct
     * @param array $data Array with Products id
     * @return array
     */
    public function store(array $data)
    {
        try {

            $sumAdjuste = [];
            if (!empty($data['id'])) {
                foreach ($data['id'] as $item) {
                    $sumAdjuste[]['id'] = $item;
                }
            }


            $userId = $data['user_id'] ?? '';
            if (!empty(Auth::user()->id)) {
                $userId = Auth::user()->id;
            }

            if (count($data['items'])) {
                foreach ($data['items'] as $item) {
                    $sumAdjuste[] = $item;
                }
            }

            $last = $this->showLastCreated();

            $lastOrderId = 1;

            $sum = $this->sumPrice($sumAdjuste ?? $data);
            $productsInformation = [];
            if ($sum['data']['itens']) {
                foreach ($sum['data']['itens'] as $itens) {
                    $productsInformation[] = $itens;
                }
            }
            if (!empty($last['data'])) {
                $lastOrderId = $last['data']->id + 1;
            }


            $store['order']['n_order'] = '#' . str_pad($lastOrderId, 8, "0", STR_PAD_LEFT);
            $store['order']['id_user'] = $userId;
            $store['order']['total_price'] = $sum['data']['total'];
            $store['order']['dt_order'] = now('America/Sao_paulo');
            $store['product'] = $productsInformation;

            $storeAll = $this->repository->store($store);

            if ($storeAll) {
                return [
                    'error' => 0,
                    'data' => $storeAll['data']
                ];
            }

            return [
                'error' => 1,
                'description' => $storeAll['description']
            ];
        } catch (\Exception $e) {
            Log::error('ORDER_SERVICE_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error creating Order.'
            ];
        }
    }

    /**
     * Store Order In Session and return Products
     * @param $request Product ID
     * @return \Illuminate\Http\Response
     */
    public function cartStore($request)
    {
        try {
            $cart = session()->get('cart');

            if (empty($cart)) {
                $cart = [
                    [
                        'id' => $request->id,
                        'quantity' => 1
                    ]
                ];

                session()->put('cart', $cart);

                return [
                    'error' => 0
                ];
            }

            $search_array = $this->searchArray($cart, 'id', $request->id);

            if (!empty($search_array)) {
                $arr_product = $search_array[0];
                $cart = $this->addQuantity($arr_product, $cart);
            } else {
                $cart[] = [
                    'id' => $request->id,
                    'quantity' => 1
                ];
            }

            session()->put('cart', $cart);


            return [
                'error' => 1,
                'description' => 'Error adding to cart.'
            ];
        } catch (\Exception $e) {
            Log::error('ORDER_SERVICE_STORE_SESSION', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error adding to cart.'
            ];
        }
    }

    /**
     * Update order
     * @param int $id Order ID
     * @param array $data Order info
     * @param string $type Type of update
     * @return array
     */
    public function update(int $id, array $data)
    {
        try {
            $info['status'] = (string) $data['status'];

            $updated = $this->repository->update($id, $info);

            if ($updated['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => $updated['data']
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error updating order.'
            ];
        } catch (\Exception $e) {
            Log::error('ORDER_SERVICE_UPDATE', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Error updating order.'
            ];
        }
    }

    /**
     * Get Products related with order
     * @param int $id Order id
     * @return array
     */
    public function showProductsFromOrderProduct(int $id)
    {
        try {
            $products =  $this->repository->showProductsFromOrderProduct($id);
            if ($products['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => $products
                ];
            }

            return [
                'error' => 1,
                'description' => $products['description']
            ];
        } catch (\Exception $e) {

            Log::error('ORDER_SERVICE_SHOW_PRODUCTS_FROM_ORDER_PRODUCT', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Error bringing the products.'
            ];
        }
    }

    /**
     * delete a many orders or single
     * @param mixed $id
     * @return array
     */
    public function delete($id)
    {
        try {
            $data = [];
            if (is_integer($id) || is_string($id)) {
                $data[] = (int) $id;
            }

            if (is_array($id)) {
                foreach ($id['id'] as $item) {
                    $data[] = (int) $item;
                }
            }

            $delete = $this->repository->delete($data);

            if ($delete['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => true
                ];
            }

            return [
                'error' => 1,
                'description' => $delete['description']
            ];
        } catch (\Exception $e) {

            Log::error('ORDER_SERVICE_DELETE', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Error deleting order.'
            ];
        }
    }

    /**
     * Check if already exist order number
     * @param string $number
     * @return array
     */
    public function showOrderFromNumber($number)
    {
        try {

            $check = $this->repository->showOrderFromNumber($number);

            if ($check['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => true
                ];
            }

            return [
                'error' => 1,
                'description' => $check['description']
            ];
        } catch (\Exception $e) {

            Log::error('ORDER_SERVICE_SHOW_ORDER_FREOM_NUMBER', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Error when checking the number.'
            ];
        }
    }

    /**
     * Get last stored
     * @return array
     */
    public function showLastCreated()
    {
        try {
            $last = $this->repository->showLastCreated();

            if ($last['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => $last['data']
                ];
            }

            return [
                'error' => 1,
                'description' => $last['description']
            ];
        } catch (\Exception $e) {

            Log::error('ORDER_SERVICE_SHOW_LAST_CREATED', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Error bringing the last order.'
            ];
        }
    }

    /**
     * Get the sum of the price of the products
     * @param array $data
     * @return array
     */
    private function sumPrice(array $data)
    {
        try {

            $ids = [];
            foreach ($data as $item) {
                $ids[] = $item['id'];
            }

            $items['ids'] = $ids;
            $items['items'] = $data;
            $products = new ProductRepository();
            $productsSum = $products->sumPrice($items);

            if ($productsSum['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => $productsSum['data']
                ];
            }

            return [
                'error' => 1,
                'description' => $productsSum['description']
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_SERVICE_SUM_PRICE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error adding prices.'
            ];
        }
    }


    /**
     * searches for an item according to the parameter
     * @param array $array
     * @param string $key
     * @param mixed $value
     * @return array
     */
    private function searchArray($array, $key, $value)
    {
        $results = array();

        if (is_array($array)) {

            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {

                $results = array_merge(
                    $results,
                    $this->searchArray($subarray, $key, $value)
                );
            }
        }

        return $results;
    }

    /**
     * Increase the quantity of products in the session
     * @param array $arr_product
     * @param array $cart
     * @return array 
     */
    private function addQuantity($arr_product, $cart)
    {
        foreach ($cart as &$c) {
            if ($c['id'] == $arr_product['id']) {
                $c['quantity'] = ++$c['quantity'];
            }
        }
        return $cart;
    }

    /**
     * Finish order
     * @return array
     */
    public function finishItems()
    {
        try {

            $cart = session()->get('cart');

            $productsId = [];

            foreach ($cart as $item) {
                $productsId[] = $item['id'];
            }
            $products = new ProductRepository();

            $productsOrder = $products->getProductsByIds($productsId);

            $productsOrderFinal = [];
            foreach ($productsOrder['data'] as $item) {
                foreach ($cart as $cartItem) {
                    if ($item['id'] == $cartItem['id']) {
                        $productsOrderFinal[] = [
                            'product' => $item,
                            'quantity' => $cartItem['quantity'],
                        ];
                        continue;
                    }
                }
            }

            if ($productsOrderFinal) {
                return [
                    'error' => 0,
                    'data' => $productsOrderFinal
                ];
            }

            return [
                'error' => 1,
                'description' => $productsOrder['description']
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_SERVICE_FINISH_ITEMS', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error bringing the final products'
            ];
        }
    }
}
