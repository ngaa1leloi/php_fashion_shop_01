<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'products';

    public function productShops()
    {
        return $this->hasMany(ProductShop::class);
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function productPromotions()
    {
        return $this->hasMany(ProductPromotion::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function billProducts()
    {
        return $this->hasMany(BillProduct::class);
    }

    public function productImages()
    {
        return $this->hasManyThrough(
            'App\Models\ProductImage',
            'App\Models\ProductColor',
            'product_id',
            'product_color_id',
            'id'
        );
    }
    
    public function promotions()
    {   
        return $this->belongsToMany(Promotion::class);
    }

    public function getPromotions()
    {
        $date_now = Carbon::now()->toDateString();
        $sum = 0;
        foreach ($this->promotions as $promo) {
            if(($promo->start_at <= $date_now) && ($date_now <= $promo->end_at)){
                $sum += $promo->discount;
            }
        }

        return $sum;        
    }
}
