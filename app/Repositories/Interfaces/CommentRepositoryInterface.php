<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CommentRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $lessonId
     *
     * @return Collection
     */
    public function getByLesson($lessonId): Collection;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function destroy($id);

    /**
     * @param int $id
     * @param int $userId
     *
     * @return Model|null
     */
    public function findComment($id, $userId);
}
