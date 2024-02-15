<?php

namespace App\Repositories;

use App\Models\Post;

class PostsRepository extends Repository
{
    public function model()
    {
        return Post::class;
    }
}
