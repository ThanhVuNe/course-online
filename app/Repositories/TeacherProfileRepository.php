<?php

namespace App\Repositories;

use App\Models\TeacherProfile;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\TeacherProfileRepositoryInterface;

class TeacherProfileRepository extends BaseRepository implements TeacherProfileRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return TeacherProfile::class;
    }

    /**
     * Update or create profile by user id
     *
     * @param string $userId
     * @param array $data
     * @return int|bool
     */
    public function updateProfile($userId, $data)
    {
        return $this->model->where('user_id', $userId)->update($data);
    }
}
