<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;

interface ProcessingRepositoryInterface extends RepositoryInterface
{
     /**
     * @param int $id
     *
     * @return Collection
     */
    public function getByUser($user_id);

    public function checkExist($userId, $lessonId);
}
