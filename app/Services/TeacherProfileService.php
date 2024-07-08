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

    public function updateOrCreate($data)
    {
        $profile = $this->teacherProfileRepo->findUser(auth()->id());
        if (!$profile) {
            return $this->teacherProfileRepo->create(array_merge(['user_id' => auth()->id()], $data));
        }
    
        return $this->teacherProfileRepo->updateProfile(auth()->id(), $data);
    }
}
