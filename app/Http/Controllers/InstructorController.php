<?php

namespace App\Http\Controllers;

use App\Services\InstructorService;
use Illuminate\Http\Request;

class InstructorController extends Controller
{

     /**
     * @var InstructorService
     */
    protected $instructorService;

    public function __construct(InstructorService $instructorService)
    {
        $this->instructorService = $instructorService;
    }
    
    public function index()
    {
        $instructors = $this->instructorService->getInstructors();
        return view('teacher.index', compact('instructors'));
    }

    public function show($id)
    {
        $instructor = $this->instructorService->getInstructor($id);

        return view('teacher.show', compact('instructor'));
    }
}
