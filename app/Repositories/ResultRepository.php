<?php

namespace App\Repositories;


use App\Models\Results;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ResultRepositoryInterface;

class ResultRepository extends BaseRepository implements ResultRepositoryInterface
{
    public function getModel()
    {
        return Results::class;
    }

    public function getByUser($userId)
    {
        return $this->model->with(['topic.questions'])->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}
