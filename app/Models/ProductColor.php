<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model
{
    protected $table = 'product_colors';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'product_id',
        'color',
    ];

    public function productShops()
    {
        return $this->hasMany(ProductShop::class);
    }

    public function billProducts()
    {
    	return $this->hasMany(BillProduct::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
