<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;

interface TeacherProfileRepositoryInterface extends RepositoryInterface
{
    /**
     * Update or create profile by user id
     *
     * @param string $userId
     * @param array $data
     * @return int|bool
     */
    public function updateProfile($userId, $data);
}
