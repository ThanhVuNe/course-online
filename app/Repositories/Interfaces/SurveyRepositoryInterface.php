<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface SurveyRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $userId
     * @return Collection
     */
    public function getRecommendCourse(int $userId);
}
