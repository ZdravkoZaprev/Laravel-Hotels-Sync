<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    public function toArray($request)
    {
        return $request->routeIs('hotels.show') ? $this->showFields() : $this->indexFields();
    }

    private function indexFields()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'stars' => $this->stars,
            'city' => $this->city ? $this->city->name : null,
        ];
    }

    private function showFields()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'address' => $this->address,
            'description' => $this->description,
            'stars' => $this->stars,
            'city' => $this->city?->name,
        ];
    }
}
