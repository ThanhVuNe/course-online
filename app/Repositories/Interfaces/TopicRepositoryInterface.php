<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;

interface TopicRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $courseId
     *
     * @return mixed
     */
    public function getTopicsWithLessons($courseId);
}
