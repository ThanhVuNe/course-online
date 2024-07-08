<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\LessonRepositoryInterface;

class LessonRepository extends BaseRepository implements LessonRepositoryInterface
{
    public function getModel()
    {
        return Lesson::class;
    }

    public function getLessonByCourse($courseId)
    {
        return $this->model->whereHas('topic', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->get();
    }

    public function getLessonByProcessing($lessonId, $userId)
    {
        return $this->model->with(['processing' => function($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->where('id', $lessonId)->first();
    }
}
