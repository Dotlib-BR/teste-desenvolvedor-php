<?php

namespace App\Http\Livewire\OrderProducts;

use App\Models\Order;
use Livewire\Component;

class Total extends Component
{
    public $order;
    public $products;
    public $discount;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount(Order $order)
    {
        $this->products = $order->orderProducts()->get();
        $this->discount = $order->discount()->first();
    }

    
    public function render()
    {
        $this->updateProducts();
        return view('livewire.order-products.total');
    }
    public function updateProducts()
    {
        $this->products = $this->order->orderProducts()->get();
    }
}
