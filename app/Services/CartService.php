<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;


class CartService
{ 
    protected $session;
    protected $item = [];

    public function __construct()
    {
        $this->session = session();
    }

    /**
     * Add product item to cart.
     *
     * @param  Product $product
     * @param  int  $quantity
     *
     * @return void
     */
    public function addToCart(Product $product, int $quantity)
    {
        $this->initCart();
        $this->makeItem($product, $quantity);

        if ($this->hasItem($product->id)) {
            $this->updateItem();
        } else {
            $this->pushItem();
        }

        $this->refreshTotal();
    }

    /**
     * Remove product item from cart.
     *
     * @param  int $id
     *
     * @return void
     */
    public function removeFromCart(int $id)
    {
        $items = $this->session->get('cart.items');
        
        foreach ($items as $key => $item) {
            if ($item['product_id'] == $id) {
                unset($items[$key]);
                break;
            }
        }

        $this->session->put('cart.items', array_values($items));

        if (! $this->session->get('cart.items')) {
            $this->removeCart();
        } else {
            $this->refreshTotal();
        }
    }

    /**
     * Load session cart from order.
     *
     * @param  Order $order
     *
     * @return void
     */
    public function loadCart(Order $order)
    {
        $this->removeCart();
        $this->initCart();
        $this->session->put('cart.discount', $order->discount);
    
        $order->load('products');
        $orderProducts = $order->products;
        
        foreach ($orderProducts as $item) {
            $product = new Product();
            $product->id = $item->id;
            $product->name = $item->name;
            $product->price = $item->pivot->price;
            $product->price_full = $product->price_full;
            
            $this->addToCart($product, $item->pivot->quantity);
        }
    }

    /**
     * Get cart session
     *
     * @return array
     */
    public function getCart()
    {
        return $this->session->get('cart');
    }

    
    /**
     * Remove cart session.
     *
     * @return void
     */
    public function removeCart()
    {
        $this->session->remove('cart');
    }

    
    /**
     * Create cart session.
     *
     * @return void
     */
    private function initCart()
    {
        if (! $this->session->has('cart')) {
            $this->session
                ->put('cart', [
                    'items' => [],
                    'discount' => 0,
                    'total' => 0,
                ]);
        } 
    }

    /**
     * Check if exists product in cart.
     *
     * @param  int $productId
     *
     * @return bool
     */
    private function hasItem(int $productId)
    {
        $items = $this->session->get('cart.items');
        
        if ($items) {
            $productIds = array_column($items, 'product_id');
            return in_array($productId, $productIds);
        }

        return false;
    }

    /**
     * Create item to insert in cart session.
     *
     * @param  Product $product
     * @param  int $quantity
     *
     * @return void
     */
    private function makeItem(Product $product, int $quantity)
    {
        if ($product && $quantity > 0) {
            $this->item = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'price_full' => $product->price_full,
                'quantity' => $quantity,
            ];
        }
    }

    /**
     * Update cart item.
     *
     * @return void
     */
    private function updateItem()
    {
        $items = $this->session->get('cart.items');

        foreach ($items as $key => $item) {
            if ($item['product_id'] == $this->item['product_id']) {
                $items[$key] = $this->item;
                break;
            }
        }

        $this->session->put('cart.items', $items);
    }

    /**
     * Add cart item.
     *
     * @return void
     */
    private function pushItem()
    {
        $this->session->push('cart.items', $this->item);
    }

    /**
     * Calculate the total of the cart in session.
     *
     * @return float
     */
    private function refreshTotal()
    {
        $total = 0;
        $discount = $this->session->get('cart.discount') ?? 0;
        $items = $this->session->get('cart.items');

        if ($items) {
            foreach ($items as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }
        
        if ($total >= $discount) {
            $total -= $discount;
        } else {
            $total = 0;
        }
        
        $this->session->put('cart.total', number_format($total, 2, ',', '.'));

        return $total;
    }
}

