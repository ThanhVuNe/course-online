<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getALlCategory();
}
