<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCoursesRequest;
use App\Services\CategoryService;
use App\Services\CourseService;
use App\Services\ReviewService;
use App\Services\SurveyService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        // dd($request, $userId);
        $courses = $this->courseService->getCourses($request);

        // dd($request->validated());
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
        // $recommend = $this->courseService->recommnedCourse($userId);
        $enrolled = false;
        $favorited = false;
        if (auth()->check()) {
            $enrolled = $this->courseService->isEnrolled((int) auth()->id(), $id);
            $favorited = $this->courseService->isFavorited((int) auth()->id(), $id);
        }

        return view('course.show', compact('course', 'reviews', 'enrolled', 'favorited'));
    }

    /**
     * @return View
     */
    public function getMyCourses(): View
    {
        $courses = $this->courseService->getMyCourses((int) auth()->id());

        return view('user.course.index', compact('courses'));
    }

    /**
     * @return View
     */
    public function getMyFavorites(): View
    {
        $courses = $this->courseService->getMyFavorites((int) auth()->id());

        return view('user.favorite.index', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     * @return RedirectResponse
     */
    public function toggleFavorite(int $courseId)
    {
        try {
            $userId = (int) auth()->id();
            
            if ($this->courseService->deleteFavorite($userId, $courseId)) {
                return response()->json(['message' => __('messages.favorite.success.delete')]);
            }
    
            return response()->json(['message' => __('messages.favorite.success.create')]);
        } catch (Exception $e) {
            return response()->json(['error' => __('messages.favorite.error.create')], 500);
        }
    }
}
