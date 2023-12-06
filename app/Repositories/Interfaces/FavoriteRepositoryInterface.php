<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface FavoriteRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return LengthAwarePaginator<Favorite>
     */
    public function getMyFavorites($userId): LengthAwarePaginator;

    public function isFavorited($userId, $courseId): bool;

    public function isFavoritedDeleted($userId, $courseId);
}
