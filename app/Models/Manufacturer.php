<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = 'manufacturers';

    protected $fillable = [
        'name',
        'country',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
