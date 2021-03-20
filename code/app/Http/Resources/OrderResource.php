<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ClientResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $client = new ClientResource($this->whenLoaded('client'));

        return [
            "id" => $this->id,
            "date" => $this->date->format("Y-m-d"), 
            "status" => $this->status_formated,
            "client_id" => $this->when(isset($client->resource->id), $client->resource->id ?? "Usuário inexistente"),
            "products" => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
