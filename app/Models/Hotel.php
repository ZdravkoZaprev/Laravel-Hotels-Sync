<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'image', 'address', 'description', 'stars',  'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
