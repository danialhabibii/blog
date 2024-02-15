<?php

namespace App\Repositories;

use App\Models\Category;

class CategoriesRepository extends Repository
{
    public function model()
    {
        return Category::class;
    }
}
