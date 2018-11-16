<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class CommentRepository extends EloquentRepository
{
    function model()
    {
        return 'App\Models\Comment';
    }
}
