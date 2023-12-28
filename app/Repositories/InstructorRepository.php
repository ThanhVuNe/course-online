<?php

namespace App\Repositories;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Repositories\Interfaces\InstructorRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class InstructorRepository extends BaseRepository implements InstructorRepositoryInterface
{
    protected const PAGINATE_DEFAULT = 15;

    public function getModel()
    {
        return User::class;
    }

    public function getInstructors()
    {
        return $this->model->with('profile')->where('role_id', UserRoleEnum::Instructor)->get();
    }

    public function getInstructor($id)
    {
        return $this->model->with(['profile','courses.topics.lessons','reviews'])->
        where('role_id', UserRoleEnum::Instructor)->findOrFail($id);
    }
}
