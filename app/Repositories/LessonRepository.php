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
}
