<?php

namespace App\Repositories\Interfaces;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface InstructorRepositoryInterface extends RepositoryInterface
{
    public function getInstructors();
    public function getInstructor($id);
}
