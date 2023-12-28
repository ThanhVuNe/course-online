<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use AmazonS3;
use App\Enums\ActiveUserEnum;
use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    /**
     * @var userRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var int
     */
    protected $maxAttempts = 5;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $request
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $request)
    {
        $attribute = Arr::except($request, ['password', 'username']);
        $attribute['username'] = strtolower($request['username']);
        $attribute['password'] = Hash::make($request['password']);
        return $this->userRepository->create($attribute);
    }

    /**
     * @param mixed $userId
     *
     * @return mixed
     */
    public function getInfor($userId)
    {
        return $this->userRepository->getInfor($userId);
    }

     /**
     * @param mixed $userId
     *
     * @return mixed
     */
    public function getInforInstructor($userId)
    {
        return $this->userRepository->getInforInstructor($userId);
    }

    /**
     * @param mixed $userId
     * @param array $data
     * @return int|bool
     */
    public function updateUser($userId, $data)
    {
        return $this->userRepository->update($userId, $data);
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function updateRole($userId)
    {
        $roleId = UserRoleEnum::Instructor;

        return $this->userRepository->findOrFail($userId)->update([
            'role_id' => $roleId,
        ]);
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function findRoleInstructor($userId)
    {
        if ($this->userRepository->findRoleInstructor($userId)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool|int
     */
    public function updatePassword($email, $password)
    {
        return $this->userRepository->updatePassword($email, Hash::make($password));
    }

    /**
     * @param string $token
     *
     * @return Model|null
     */
    public function findUser($token)
    {
        return $this->userRepository->findUser($token);
    }

      /**
     * @param string $email
     *
     * @return bool
     */
    public function checkLoginAttempts($email)
    {
        $result = false;
        $user = $this->userRepository->findUserByMail($email);
        if ($user) {
            $user->login_attempts++;
            if ($user->login_attempts >= $this->maxAttempts) {
                $user->is_active = ActiveUserEnum::UnActive;
                $result = true;
            }
            $user->save();
        }
        return $result;
    }
}
