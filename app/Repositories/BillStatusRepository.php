<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class BillStatusRepository extends EloquentRepository
{
    function model()
    {
        return 'App\Models\BillStatus';
    }
}
