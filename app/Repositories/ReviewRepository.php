<?php

namespace App\Repositories;

use App\Models\Review;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    /**
     * Get the model instance for the repository.
     *
     * @return string
     */
    public function getModel(): string
    {
        return Review::class;
    }

    /**
     * @param int $id of course
     * @return Collection
     */
    public function getReviewsByCourse(int $id): Collection
    {
        return $this->model->with('user.profile')->where('course_id', $id)->get();
    }
}
