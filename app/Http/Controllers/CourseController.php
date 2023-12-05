<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCoursesRequest;
use App\Models\Course;
use App\Models\Survey;
use App\Services\CategoryService;
use App\Services\CourseService;
use App\Services\ReviewService;
use App\Services\SurveyService;
use Illuminate\Contracts\View\View;

class CourseController extends Controller
{
    /**
     * @var CourseService
     */
    protected $courseService;

    /**
     * @var ReviewService
     */
    protected $reviewService;

    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @var SurveyService
     */
    protected $surveylService;

    public function __construct(
        CourseService $courseService,
        ReviewService $reviewService,
        CategoryService $categoryService,
        SurveyService $surveylService
    ) {
        $this->courseService = $courseService;
        $this->reviewService = $reviewService;
        $this->categoryService = $categoryService;
        $this->surveylService = $surveylService;
    }

    /**
     * @return View
     */
    public function index(GetCoursesRequest $request): View
    {
        $userId = (int) auth()->id();

        $courses = $this->courseService->getCourses($request);

        $courses->appends($request->validated());

        $categories = $this->categoryService->getAll(['id', 'name']);

        $recommend = $this->courseService->recommnedCourse($userId);

        return view('course.index', compact('courses', 'categories', 'recommend'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $userId = (int) auth()->id();
        $course = $this->courseService->getCourse($id);
        $reviews = $this->reviewService->getReviewsByCourse($id);
        $recommend = $this->courseService->recommnedCourse($userId);
        $enrolled = false;
        if (auth()->check()) {
            $enrolled = $this->courseService->isEnrolled((int) auth()->id(), $id);
        }

        return view('course.show', compact('course', 'reviews', 'enrolled', 'recommend'));
    }

    /**
     * @return View
     */
    public function getMyCourses(): View
    {
        $courses = $this->courseService->getMyCourses((int) auth()->id());

        return view('user.course.index', compact('courses'));
    }
}
