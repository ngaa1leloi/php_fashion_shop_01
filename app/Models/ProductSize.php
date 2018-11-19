<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
    use SoftDeletes;

    protected $table = 'product_sizes';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'product_id',
        'size',
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
}
