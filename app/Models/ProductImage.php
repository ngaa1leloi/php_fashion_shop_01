<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_color_id',
        'image',
    ];

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class);
    }
}
