<?php

namespace App\Services;

use App\Repositories\Interfaces\ResetPasswordRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ResetPasswordService
{
    /**
     * @var ResetPasswordRepositoryInterface
     */
    protected $resetPasswordRepo;

    public function __construct(ResetPasswordRepositoryInterface $resetPasswordRepo)
    {
        $this->resetPasswordRepo = $resetPasswordRepo;
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        return $this->resetPasswordRepo->getByEmail($email);
    }

    /**
     * @param string $email
     * @param string $token
     * @param string $expiredTime
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function addResetPassWord($email, $token, $expiredTime)
    {
        return $this->resetPasswordRepo->addResetPassWord($email, $token, $expiredTime);
    }

    /**
     * Delete a record based on email or token.
     *
     * @param string $email
     * @return int|bool True if the deletion was successful, false otherwise.
     */
    public function deleteByEmail($email)
    {
        return $this->resetPasswordRepo->deleteByEmail($email);
    }

    /**
     * @param string $token
     * @param string $expiredTime
     * @return mixed
     */
    public function isExpiredToken($token, $expiredTime)
    {
        return $this->resetPasswordRepo->isExpiredToken($token, $expiredTime);
    }
}
