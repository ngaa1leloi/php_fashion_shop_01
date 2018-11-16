<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class SlideRepository extends EloquentRepository
{
    function model()
    {
        return 'App\Models\Slide';
    }
}
