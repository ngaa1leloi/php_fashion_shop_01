<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class ProductColorRepository extends EloquentRepository
{
    function model()
    {
        return 'App\Models\ProductColor';
    }
}
