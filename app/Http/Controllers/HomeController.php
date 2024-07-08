<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use App\Services\InstructorService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
     /**
     * @var CourseService
     */
    protected $courseService;

     /**
     * @var InstructorService
     */
    protected $instructorService;

    public function __construct(
        CourseService $courseService,
        InstructorService $instructorService
    ) {
        $this->courseService = $courseService;
        $this->instructorService = $instructorService;
    }

    public function home(): View
    {
        $courseLatest = $this->courseService->getCourseLatest();
        $instructors = $this->instructorService->getInstructors();

        return view('home', compact('courseLatest', 'instructors'));
    }
}
