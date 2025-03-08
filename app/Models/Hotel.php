<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JsonSerializable;

class Hotel extends Model implements JsonSerializable
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'image', 'address', 'description', 'stars',  'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'stars' => $this->stars,
            'city' => $this->city ? $this->city->name : null,
            'description' => $this->description
        ];
    }
}
