<?php

namespace App\Repositories;

use App\Models\Favorite;
use App\Repositories\Interfaces\FavoriteRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class FavoriteRepository extends BaseRepository implements FavoriteRepositoryInterface
{
    protected const PAGINATE_DEFAULT = 15;

    public function getModel()
    {
        return Favorite::class;
    }

    /**
     * @param int $userId
     *
     * @return LengthAwarePaginator<Favorite>
     */
    public function getMyFavorites($userId): LengthAwarePaginator
    {
        /** @phpstan-ignore-next-line */
        return $this->model->with('course.category:id,name')
            ->owner($userId)->paginate(self::PAGINATE_DEFAULT);
    }

    public function isFavorited($userId, $courseId): bool
    {
        return $this->model->where('course_id', $courseId)
        ->owner($userId)->get()->count();
    }

    public function isFavoritedDeleted($userId, $courseId)
    {
        return $this->model->withTrashed()->where('course_id', $courseId)
        ->owner($userId)->first();
    }
}
