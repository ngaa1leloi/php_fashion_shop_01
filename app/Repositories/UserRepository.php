<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository
{
    function model()
    {
        return 'App\Models\User';
    }
}
