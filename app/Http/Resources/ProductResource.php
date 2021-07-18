<?php

namespace App\Http\Resources;

use App\Models\OrderProduct;
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
            'name' => $this->name,
            'price' => $this->price,
            'reference' => $this->reference,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'suppliers' => $this->whenLoaded('suppliers'),
            'quantity' => $this->whenPivotLoaded(new OrderProduct(), fn () => $this->pivot->quantity),
            'selling_price' => $this->whenPivotLoaded(new OrderProduct(), fn () => $this->pivot->selling_price),
        ];
    }
}
