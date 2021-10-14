<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
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
            'customer_id' => $this->customer_id,
            'address' => $this->address,
            'city' => $this->city,
            'pincode' => $this->pincode,
            'work_phone' => $this->work_phone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
