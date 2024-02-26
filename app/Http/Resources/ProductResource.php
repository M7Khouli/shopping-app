<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'brand'=>$this->brand,
            'description'=>$this->description,
            'color'=>$this->color,
            'quantity'=>$this->quantity,
            'availability'=>$this->availability,
            'size'=>$this->size,
            'category'=>$this->category,
            'subcategory'=>$this->subcategory
        ];
    }
}
