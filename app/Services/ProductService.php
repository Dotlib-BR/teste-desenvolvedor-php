<?php

namespace App\Services;

use App\Models\Product;

class ProductService {
    /**
     * Create product in Database
     *
     * @param string $code
     * @param string $name
     * @param int $warehouse_quantity
     * @param float $value
     * @return Product
     */
    public function createProduct(string $code, string $name, int $warehouse_quantity, float $value)
    {
        $product = new Product();
        $product->code = $code;
        $product->name = $name;
        $product->warehouse_quantity = $warehouse_quantity;
        $product->value = $value;
        $product->save();

        return $product;
    }

    /**
     * Get product from database from id
     *
     * @param int $id
     * @return Product|null
     */
    public function getProductById(int $id)
    {
        $product = Product::find($id);

        return $product;
    }

    /**
     * Get products by database, filters as params
     *
     * @param int $per_page
     * @param int $page
     * @param string $searchTerm
     * @param string $orderBy
     * @param string $orderDirection
     * @return Product[]
     */
    public function getProducts(int $per_page = 20, int $page = 0, string $searchTerm = '', string $orderBy = 'id', string $orderDirection = 'ASC'): array {
        $products = Product::
            orderBy($orderBy, $orderDirection)
            ->where('name', 'ILIKE', '%' . $searchTerm . '%')
            ->orWhere('code', 'ILIKE', '%' . $searchTerm . '%')
            ->skip($per_page * $page)
            ->take($per_page)
            ->get();

        return $products->all();
    }

    /**
     * Update product in Database
     *
     * @param Product $product
     * @param string $code
     * @param string $name
     * @param int $warehouse_quantity
     * @param float $value
     * @return Product
     */
    public function updateProduct(Product $product, string $code, string $name, int $warehouse_quantity, float $value): Product
    {
        $product->code = $code;
        $product->name = $name;
        $product->warehouse_quantity = $warehouse_quantity;
        $product->value = $value;
        $product->save();

        return $product;
    }

    /**
     * Delete product in Database
     *
     * @param int $id
     * @return void
     */
    public function deleteProductById(int $id): void
    {
        Product::where('id', $id)->delete();
    }

    /**
     * Get products count from database, params to filter
     *
     * @param string $searchTerm
     * @return int
     */
    public function getProductsCount(string $searchTerm = ''): int
    {
        return Product::where('name', 'ILIKE', '%' . $searchTerm . '%')
            ->orWhere('code', 'ILIKE', '%' . $searchTerm . '%')
            ->count();
    }
}
