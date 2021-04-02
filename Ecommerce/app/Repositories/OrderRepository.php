<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderRepository implements OrderRepositoryInterface
{

    private $model;
    private $userRepository;

    public function __construct()
    {
        $this->model = new order();
        $this->userRepository = new UserRepository();
    }

    /**
     * List all Order
     * @param array $data Filter info
     * @return array A array with error and data or error with description error
     */
    public function index(array $data = [])
    {
        try {
            $perPage = (int) (!empty($data['perPage'])) ? $data['perPage'] : 10;
            $list = [];
            if (!empty($data['all'])) {
                $list = $this->model->get();
            }
            
            if (!count($list)) {
                
                $list = $this->model;

                if(!empty($data['user']['status'])){
                    $id = ($data['user']['status'] === 'current')? Auth::user()->id : $data['user']['id'];
                    $list = $list->where('id_user', $id);
                }

                if(!empty($data['status'])){
                    $status = (string) ($data['status'] - 1);
                    $list = $list->where('status', $status);
                }
                
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

            Log::error('ORDER_REPOSITORY_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error bringing all products.'
            ];
        }
    }


    /**
     * List Order with pagination
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
                'description' => 'Error picking up products.'
            ];
        } catch (\Exception $e) {
            Log::error('ORDER_REPOSITORY_INDEX_PAGE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error picking up products.'
            ];
        }
    }

    /**
     * Store Order and Store orderProduct
     * @param array $data Array with order description and products
     * @return array A array with error and data or error with description error
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $order = $data['order'];
            $products = $data['product'];
            $order = $this->model::create($order);
            $response = [];
            if ($order) {
                $response['order'] = $order;
            }

            $orderProductRepository = new OrderProductRepository();

            $orderProduct = [];
            if ($products) {
                foreach ($products as $product) {
                    $product['id_order'] = $order->id;
                    $orderProduct[] = $product;
                    $orderProduct[] = $orderProductRepository->store($product);
                }
            }

            if (!empty($orderProduct)) {
                foreach ($orderProduct as $item) {
                    if (!empty($item['data'])) {
                        $response['order']['products'] = $item['data'];
                    }
                }
            }

            DB::commit();
            return [
                'error' => 0,
                'data' => $response
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ORDER_REPOSITORY_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);
            return [
                'error' => 1,
                'description' => 'Error registering order'
            ];
        }
    }

    /**
     * Update order
     * @param int $id Order id
     * @param array $data Order info 
     * @return array A array with error and data or error with description error
     */
    public function update(int $id, array $data)
    {
        try {

            $updated = $this->model::where('id', $id)->update($data);

            if (!empty($updated)) {
                return [
                    'error' => 0,
                    'data' => $updated
                ];
            }

            return [
                'error' => 1,
                'description' => 'Order information error.'
            ];
        } catch (\Exception $e) {
            Log::error('ORDER_REPOSITORY_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Order information error.'
            ];
        }
    }

    /**
     * Delete one order or many order
     * @param array $id
     * @return array A array with error and data or error with description error
     */
    public function delete(array $id)
    {
        try {
            $order = $this->model::whereIn('id', $id)->delete();

            if ($order) {
                return [
                    'error' => 0,
                    'data' => $order
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error deleting orders.'
            ];
        } catch (\Exception $e) {

            Log::error('ORDER_REPOSITORY_DELETE', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Error deleting orders.'
            ];
        }
    }

    /**
     * Show order with orderProducts
     * @param int $id Order id
     * @return array A array with error and data or error with description error
     */
    public function show(int $id)
    {
        try {
            
            $data = $this->model::where('id', $id)->with('OrderProduct')->get();
            $order = $data[0];

            $productsId = [];
            $orderProduct = [];
            foreach ($data[0]['OrderProduct'] as $item) {
                $productsId['ids'][] = $item->id_product;
                $orderProduct[] = $item;
            }

            $userRepository = new UserRepository();

            $user = $userRepository->show($order->id_user);

            $productRepository = new ProductRepository();
            $products = $productRepository->index($productsId);
            
            $final = [
                'order' => $order,
                'orderProduct' => $orderProduct,
                'products' => $products
            ];

            if(!empty($user['data'])){
                $final['user'] = $user['data'];
            }
            
            if (!empty($final)) {
                return [
                    'error' => 0,
                    'data' => $final
                ];
            }

            return [
                'error' => 1,
                'data' => 'Error bringing order.'
            ];
        } catch (\Exception $e) {
            Log::error('ORDER_REPOSITORY_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);
            return [
                'error' => 1,
                'description' => 'Error bringing order.'
            ];
        }
    }

    /**
     * Get Products related with order
     * @param int $id Order id
     * @return array A array with error and data or error with description error
     */
    public function showProductsFromOrderProduct(int $id)
    {
        try {
            $products = $this->model::where('id', $id)->first()->orderProduct()->get();

            if ($products) {
                return [
                    'error' => 0,
                    'data' => $products
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error bringing the products.'
            ];
        } catch (\Exception $e) {

            Log::error('ORDER_REPOSITORY_SHOW_PRODUCTS_FROM_ORDER_PRODUCT', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Error bringing the products.'
            ];
        }
    }

    /**
     * Check if already exist order number
     * @param string $number Order Number
     * @return array A array with error and data or error with description error
     */
    public function showOrderFromNumber(string $number)
    {
        try {

            $check = $this->model::where('n_order', $number)->first()->get();

            if ($check) {
                return [
                    'error' => 0,
                    'data' => true
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error when checking the number.'
            ];
        } catch (\Exception $e) {

            Log::error('ORDER_REPOSITORY_SHOW_ORDER_FREOM_NUMBER', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Error when checking the number.'
            ];
        }
    }

    /**
     * Get last stored
     * @return array A array with error and data or error with description error
     */

    public function showLastCreated()
    {
        try {

            $last = $this->model::orderBy('dt_order', 'desc')->first();

            if ($last) {
                return [
                    'error' => 0,
                    'data' => $last
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error bringing the last order.'
            ];
        } catch (\Exception $e) {

            Log::error('ORDER_REPOSITORY_SHOW_LAST_CREATED', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Error bringing the last order.'
            ];
        }
    }
}
