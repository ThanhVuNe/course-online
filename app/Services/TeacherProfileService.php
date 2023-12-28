<?php

namespace App\Services;

use App\Repositories\Interfaces\TeacherProfileRepositoryInterface;

class TeacherProfileService
{
    /**
     * @var TeacherProfileRepositoryInterface
     */
    protected $teacherProfileRepo;

    public function __construct(TeacherProfileRepositoryInterface $teacherProfileRepo)
    {
        $this->teacherProfileRepo = $teacherProfileRepo;
    }

    public function update($data)
    {
        return $this->teacherProfileRepo->updateProfile(auth()->id(), $data);
    }
}
