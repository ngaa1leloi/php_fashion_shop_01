<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class ProductRepository extends EloquentRepository
{
    function model()
    {
        return 'App\Models\Product';
    }

    public function productSale()
    {
        $result = $this->model->has('productPromotions')->paginate(config('paginate.product_2'));

        return $result;
    }

    public function productNew()
    {
        $result = $this->model->orderBy('id', 'desc')->paginate(config('paginate.product_2'));
        
        return $result;
    }

    public function productMostView()
    {
        $result = $this->model->orderBy('viewed_count', 'desc')->paginate(config('paginate.product'));
        
        return $result;
    }

    public function productBestSeller()
    {
        $result = $this->model->orderBy('purchased_count', 'desc')->paginate(config('paginate.product_2'));
        
        return $result;
    }

    public function searchProduct($var)
    {
        $result = $this->model->where('name', 'like', '%' . $var . '%')->get();
        
        return $result;
    }
}
