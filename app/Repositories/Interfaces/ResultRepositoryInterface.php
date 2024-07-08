<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;

interface ResultRepositoryInterface extends RepositoryInterface
{
    public function getByUser($userId);
}
