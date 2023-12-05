<?php

namespace App\Services;

use App\Repositories\Interfaces\ProfileRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProfileService
{
    /**
     * @var profileRepositoryInterface
     */
    protected $profileRepo;

    public function __construct(ProfileRepositoryInterface $profileRepo)
    {
        $this->profileRepo = $profileRepo;
    }

    /**
     * Update or create profile by user id
     *
     * @param mixed $userId
     * @param array $data
     * @return int|bool|Model
     */
    public function updateOrCreateProfile($userId, $data = [])
    {
        $profile = $this->profileRepo->findUser($userId);
        if (!$profile) {
            return $this->profileRepo->create(array_merge(['user_id' => $userId], $data));
        }

        return $this->profileRepo->updateProfile($userId, $data);
    }

    /**
     * Update or create profile by user id
     *
     * @param mixed $userId
     * @param array $data
     * @return int|bool|Model
     */
    public function create($userId, $data = [])
    {
        return $this->profileRepo->create(array_merge(['user_id' => $userId], $data));
    }
}
