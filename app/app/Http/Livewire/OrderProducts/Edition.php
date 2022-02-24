<?php

namespace App\Http\Livewire\OrderProducts;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Collection;
use Livewire\Component;

class Edition extends Component
{
    public $order;
    public $products;
    public $newProduct;
    public $discount = null;

    protected $listeners = ['selected'];

    protected $rules = [
        'newProduct.product_id' => 'required|integer',
        'newProduct.quantity' => 'required|integer|min:1',
        'newProduct.order_id' => 'required|integer',
        'newProduct.unit_price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->products = $order->orderProducts;
        $this->newProduct = null;
    }

    public function selected($product)
    {
        $this->newProduct->product_id = $product['id'];
        $this->newProduct->unit_price = $product['price'];
    }

    public function makeNewOrderProduct()
    {
        $this->newProduct = new OrderProduct($this->getNullValues());
        $this->newProduct->order_id = $this->order->id;
    }
    
    public function getNullValues()
    {
        return [
            'order_id' => null,
            'product_id' => null,
            'quantity' => null,
            'unit_price' => null,
        ];
    }

    public function create()
    {
        $validated = $this->validate();
        OrderProduct::create(...array_values($validated));
        $this->newProduct = null;
        $this->getOrderProducts();
    }

    public function delete($id)
    {
        OrderProduct::find($id)->delete();
        $this->getOrderProducts();
    }

    public function getOrderProducts()
    {
        $this->products = $this->order->orderProducts()->get();
        $this->emitTo(Total::class, 'refresh');
    }

    public function render()
    {
        return view('livewire.order-products.edition');
    }
}
