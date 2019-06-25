<?php


namespace App\Http\Repositories;


abstract class Repository
{
    public abstract function model();
    
    public function count()
    {
        return $this->model()->count();
    }
    
    public function all()
    {
        return $this->model()->all();
    }
    
    public function find($id)
    {
        return $this->model()->find($id);
    }
}
