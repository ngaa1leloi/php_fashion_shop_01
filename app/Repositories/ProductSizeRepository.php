<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class ProductSizeRepository extends EloquentRepository
{
    function model()
    {
        return 'App\Models\ProductSize';
    }
}
