<?php

namespace App\Moldels;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class);
    }
}
