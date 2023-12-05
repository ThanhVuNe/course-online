<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    /**
     * Get the model instance for the repository.
     *
     * @return string
     */
    public function getModel(): string
    {
        return Cart::class;
    }

    /**
     * Check the presence of courses whether are in cart or not.
     * @param int $userId
     * @param int $courseId
     * @return bool
     */
    public function hasCourseInCart(int $userId, int $courseId): bool
    {
        return $this->model->where('user_id', $userId)->where('course_id', $courseId)->exists();
    }

    /**
     * @param int $id of user
     * @return Collection
     */
    public function getCartByUser(int $id): Collection
    {
        return $this->model
            ->with('course:id,title,price,poster_url,discount')
            ->where('user_id', $id)
            ->get();
    }

    /**
     * @param array $id
     * @return Collection
     */
    public function getCourseToCart($id)
    {
        return $this->model->with('course:id,title,price,discount,introduction')->whereIn('id', $id)->get();
    }

    /**
     * @param array $ids
     * @param int $userId
     * @return bool
     */
    public function deleteMultiple($ids, $userId): bool
    {
        return $this->model->where('user_id', $userId)->whereIn('id', $ids)->delete();
    }
}
