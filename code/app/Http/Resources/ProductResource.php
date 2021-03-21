<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'total_quantity' => $this->quantity,
            'unit_price'=> $this->price,
            'bar_code' => $this->bar_code,
            'orders' => $this->whenLoaded("orders"),
            "quantity_purchased" => $this->whenPivotLoaded('order_product', fn() => $this->pivot->quantity),
            "total_price" => $this->whenPivotLoaded('order_product', fn() => $this->pivot->quantity * $this->price),
        ];
    }
}
