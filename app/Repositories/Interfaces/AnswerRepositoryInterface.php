<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;

interface AnswerRepositoryInterface extends RepositoryInterface
{
    public function getAnswers($answerIds);
}
