<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    /**
     * Array of available attributes.
     *
     * @var array
     */
    protected $fillable = ['name', 'garages', 'bedrooms', 'bathrooms', 'storeys', 'garages'];
}
