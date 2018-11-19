<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillProduct extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'bill_product';
    
    protected $fillable = [
        'bill_id',
        'product_id',
        'product_color_id',
        'product_size_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
