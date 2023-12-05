<?php

namespace App\Services;

use App\Repositories\Interfaces\CartRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class CartService
{
    /**
     * @var CartRepositoryInterface
     */
    protected $cartRepo;

    public function __construct(CartRepositoryInterface $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    /**
     * Add courses into cart
     * @param int $userId
     * @param int $courseId
     * @return Model
     * @throws Exception
     */
    public function addToCart(int $userId, int $courseId): Model
    {
        if ($this->cartRepo->hasCourseInCart($userId, $courseId)) {
            throw new Exception();
        }
        $data = [
            'user_id' => $userId,
            'course_id' => $courseId,
        ];

        return $this->cartRepo->create($data);
    }

    /**
     * @param int $id of user
     * @return Collection
     */
    public function getCartByUser(int $id): Collection
    {
        return $this->cartRepo->getCartByUser($id);
    }

    /**
     * @param array $ids
     * @param int $userId
     * @return bool
     */
    public function deleteCarts($ids, $userId)
    {
        return $this->cartRepo->deleteMultiple($ids, $userId);
    }

    /**
     * Delete a record by course id.
     *
     * @param int $id .
     * @return bool True if the deletion was successful, false otherwise.
     */
    public function deleteCart($id)
    {
        return $this->cartRepo->delete($id);
    }

    /**
     * @param int $userId
     *
     * @return int
     */
    public function getCountCart($userId)
    {
        return count($this->cartRepo->getCartByUser($userId));
    }

    /**
     * @param array $id
     * @return Collection
     */
    public function findSelectCart($id)
    {
        return $this->cartRepo->getCourseToCart($id);
    }
}
