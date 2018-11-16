<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class BillRepository extends EloquentRepository
{
    function model()
    {
        return 'App\Models\Bill';
    }
}
