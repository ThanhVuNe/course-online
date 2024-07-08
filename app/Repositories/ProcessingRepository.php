<?php

namespace App\Repositories;

use App\Models\Processing;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ProcessingRepositoryInterface;

class ProcessingRepository extends BaseRepository implements ProcessingRepositoryInterface
{
    public function getModel()
    {
        return Processing::class;
    }

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function getByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }

    public function checkExist($userId, $lessonId)
    {
        return $this->model->where('user_id', $userId)->where('lesson_id', $lessonId)->first();
    }
}
