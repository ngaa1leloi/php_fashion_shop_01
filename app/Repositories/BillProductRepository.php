<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class BillProductRepository extends EloquentRepository
{
    function model()
    {
        return 'App\Models\BillProduct';
    }
}
