<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Repositories\CategoriesRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categories;

    public function __construct(CategoriesRepository $categories)
    {
        $this->categories = $categories;
    }

    public function all()
    {
        return CategoryResource::collection($this->categories->all());
    }
}
