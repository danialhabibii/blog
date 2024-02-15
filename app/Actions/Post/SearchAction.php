<?php

namespace App\Actions\Post;

use App\Models\Post;

class SearchAction
{
    public function execute(string $value)
    {
        return Post::search($value)->get();
    }
}
