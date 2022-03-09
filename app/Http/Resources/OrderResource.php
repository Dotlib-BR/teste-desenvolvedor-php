<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\{ CustomerResource, ProductResource };

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'customer' => new CustomerResource($this->customer),
            'product' => new ProductResource($this->product),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
