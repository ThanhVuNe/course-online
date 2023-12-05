<?php

namespace App\Repositories;

use App\Models\Topic;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TopicRepository extends BaseRepository implements TopicRepositoryInterface
{
    public function getModel()
    {
        return Topic::class;
    }

    /**
     * @param int $courseId
     *
     * @return Collection
     */
    public function getTopicsWithLessons($courseId)
    {
        return $this->model->with('lessons')->where('course_id', $courseId)->get();
    }
}
