<?php

namespace App\Repositories;

use App\Models\Answers;
use App\Repositories\Interfaces\AnswerRepositoryInterface;

class AnswerRepository extends BaseRepository implements AnswerRepositoryInterface
{
    protected const PAGESIZE = 10;
    
    public function getModel()
    {
        return Answers::class;
    }

    public function getAnswers($answerIds)
    {
        return $this->model->with('question')->whereIn('id', $answerIds)->get();
    }
}
