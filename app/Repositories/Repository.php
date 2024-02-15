<?php

namespace App\Repositories;

abstract class Repository
{
    protected $model;

    abstract public function model();

    public function __construct()
    {
        $this->model = app($this->model());
    }


    //some methods
    public function all()
    {
        return $this->model->all();
    }

    public function getByCategory($model)
    {
        return $model->posts;
    }

    public function newest()
    {
        return $this->model->latest('id')->get();
    }
}
