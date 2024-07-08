<?php

namespace App\Repositories;


use App\Models\Questions;
use App\Repositories\Interfaces\QuestionRepositoryInterface;

class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{
    protected const PAGESIZE = 10;
    
    public function getModel()
    {
        return Questions::class;
    }

   
}
