<?php

namespace App\Repositories;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * @param string $userId
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function getInfor($userId)
    {
        return $this->model->with('profile')->find($userId);
    }

    /**
     * @param string $email
     * @param string $password
     * @return int|bool
     */
    public function updatePassword($email, $password)
    {
        return $this->model->where("email", $email)->update(["password" => $password]);
    }

    /**
     * @param int $userId
     * @return Model|null
     */
    public function findRoleInstructor($userId)
    {
        return $this->model->where('id', $userId)->where('role_id', UserRoleEnum::Instructor)->first();
    }

    /**
     * @param string $token
     *
     * @return Model|null
     */
    public function findUser($token)
    {
        return $this->model->where('token_authentication', $token)->first();
    }
}
