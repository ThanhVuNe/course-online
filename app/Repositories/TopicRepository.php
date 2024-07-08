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
    public function getTopicsWithLessons($courseId, $userId)
    {
        return $this->model
        ->with(['lessons.processing' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        },'results' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])
        ->where('course_id', $courseId)
        ->get();
    }

    public function getQuestionsByTopic($topicId) {
        return $this->model->with(['questions.answers']) 
            ->where('id', $topicId)
            ->first();
    }
}
