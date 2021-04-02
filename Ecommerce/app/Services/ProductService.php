<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Repositories\ProductRepository;

class ProductService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }

    /**
     * List all Products with per page or not
     * @param array $data
     * @return array 
     */
    public function index(array $filter = [])
    {
        try {
            $data = [];

            if (!empty($filter['filter']) && empty($data)) {
                $filter['order'] = 'DESC';

                if ($filter['filter'] === 'name' || $filter['filter'] === 'low') {
                    $filter['filter'] = ($filter['filter'] === 'name') ? 'name_product' : 'price';
                    $filter['order'] = 'ASC';
                }

                $filter['filter'] = ($filter['filter'] === 'high') ? 'price' : $filter['filter'];
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
                'description' => 'Error bringing all products.'
            ];
        } catch (\Exception $e) {

            Log::error('PRODUCT_SERVICE_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

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

            if (!empty($data['image'])) {
                $image = $data['image'];
                unset($data['image']);
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public/img/product', $imageName);
                $data['product_image'] = $imageName;
            }

            if (!empty($data['discount_status'])) {
                $data['discount_status'] = '1';
            }

            $store = $this->repository->store($data);

            if ($store['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => $store
                ];
            }

            return [
                'error' => 1,
                'description' => $store['description']
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_SERVICE_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'There was an unexpected error when registering.'
            ];
        }
    }

    /**
     * Get a Product
     * @param int $ids 
     * @return array 
     */
    public function show(int $id)
    {

        try {
            $product = $this->repository->show($id);

            if ($product['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => $product['data']
                ];
            }

            return [
                'error' => 1,
                'description' => $product['description']
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_SERVICE_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error bringing product.'
            ];
        }
    }

    /**
     * Update a Product
     * @param int $id Product id
     * @return array 
     */
    public function update(int $id, array $data)
    {
        try {

            if (!empty($data['image'])) {
                $image = $data['image'];
                unset($data['image']);
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public/img/product', $imageName);
                $data['product_image'] = $imageName;
            }

            if(!empty($data['_method'])) {
                unset($data['_method']);
            }

            if (!empty($data['discount_status'])) {
                $data['discount_status'] = '1';
            }

            $update = $this->repository->update($id, $data);

            if ($update['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => $update
                ];
            }

            return [
                'error' => 1,
                'description' => $update['description']
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_SERVICE_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'There was an unexpected error while updating.'
            ];
        }
    }

    /**
     * delete a many products or single
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

            Log::error('PRODUCT_SERVICE_DELETE', $e->getMessage(), $e->getFile(), $e->getLine());

            return [
                'error' => 1,
                'description' => 'Error deleting the product.'
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

            $product = $this->repository->checkIfProductHasImage($id);

            if ($product) {
                return [
                    'error' => 0,
                    'data' => $product['data']
                ];
            }


            return [
                'error' => 1,
                'description' => 'Erro ao checar.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_SERVICE_CHECK_IF_PRODUCTS_HAS_IMAGE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao checar.'
            ];
        }
    }
}
