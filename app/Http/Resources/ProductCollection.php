<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request) { 
        return [ 
            'id' => $this->id,
            'name'=> $this->name,
            'price'=> $this->price,
            'brand'=> $this->brand
        ];
    }
    
}