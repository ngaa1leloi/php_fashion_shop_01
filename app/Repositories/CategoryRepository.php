<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class CategoryRepository extends EloquentRepository
{
    function model()
    {
        return 'App\Models\Category';
    }
}
