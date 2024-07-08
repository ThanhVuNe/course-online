<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected const PAGESIZE = 10;
    
    public function getModel()
    {
        return Category::class;
    }

    public function getALlCategory()
    {
        return $this->model->paginate(self::PAGESIZE);
    }
}
