<?php

namespace App\Repositories;

use App\Models\ResetPassword;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ResetPasswordRepositoryInterface;

class ResetPasswordRepository extends BaseRepository implements ResetPasswordRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return ResetPassword::class;
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * @param string $email
     * @param string $token
     * @param string $expiredTime
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function addResetPassWord($email, $token, $expiredTime)
    {
        return $this->model->updateOrCreate(
            [
                'email' => $email,
            ],
            [
                'token' => $token,
                'expired_at' => $expiredTime
            ]
        );
    }

    /**
     * @param string $email
     * @return int|bool True if the deletion was successful, false otherwise.
     */
    public function deleteByEmail($email)
    {

        return $this->model->where('email', $email)->delete();
    }

    /**
     * @param string $token
     * @param string $expiredTime
     * @return mixed
     */
    public function isExpiredToken($token, $expiredTime)
    {
        return $this->model->where('token', $token)->where('expired_at', '>', $expiredTime)->first();
    }
}
