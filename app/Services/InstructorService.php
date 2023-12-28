<?php

namespace App\Services;

use App\Repositories\Interfaces\InstructorRepositoryInterface;

class InstructorService
{
    /**
     * @var InstructorRepositoryInterface
     */
    protected $instructorRepo;

    public function __construct(InstructorRepositoryInterface $instructorRepo)
    {
        $this->instructorRepo = $instructorRepo;
    }

    public function getInstructors()
    {
        return $this->instructorRepo->getInstructors();
    }

    public function getInstructor($id)
    {
        return $this->instructorRepo->getInstructor($id);
    }
}
