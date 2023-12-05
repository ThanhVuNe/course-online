<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * Get the model instance for the repository.
     *
     * @return string
     */
    public function getModel(): string
    {
        return Order::class;
    }
}
