<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;

interface LessonRepositoryInterface extends RepositoryInterface
{
    public function getLessonByCourse($courseId);

    public function getLessonByProcessing($lessonId, $userId);
}
