<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface ReviewRepositoryInterface extends RepositoryInterface
{
    public function getReviewsByCourse(int $id): Collection;
}
