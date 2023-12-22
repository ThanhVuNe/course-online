<?php

namespace App\Http\Controllers\Instructor;

use AmazonS3;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Services\CategoryService;
use App\Services\CourseService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CourseController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @var CourseService
     */
    protected $courseService;

    public function __construct(CategoryService $categoryService, CourseService $courseService)
    {
        $this->categoryService = $categoryService;
        $this->courseService = $courseService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $courses = $this->courseService->getInstructorCourses((int)auth()->id());
        return view('instructor.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = $this->categoryService->getAll();
        return view('instructor.course.create', compact('categories'));
    }

    /**
     * @param int $courseId
     *
     * @return View
     */
    public function upload($courseId): View
    {
        return view('instructor.course.upload', ['courseId' => $courseId]);
    }

    /**
     * @param StoreCourseRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['instructor_id'] = auth()->id();
        $course = $this->courseService->create($data);
        $courseId = $course->id;

        return redirect()->route('instructor.courses.upload', ['courseId' => $courseId]);
    }

    /**
     * Generate and return a pre-signed upload URL for a user's profile image.
     * @param int $courseId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUploadUrl($courseId)
    {
        $userId = auth()->id();
        $pathImage = "instructor/{$userId}/course_{$courseId}/poster.jpg";
        $pathVideo = "instructor/{$userId}/course_{$courseId}/trailer.mp4";

        return response()->json([
            'urlImage' => AmazonS3::getPreSignedUploadUrl($pathImage),
            'urlVideo' => AmazonS3::getPreSignedUploadUrl($pathVideo)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param int $courseId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUrl($courseId)
    {
        $userId = auth()->id();
        $data = [];
        $data['poster_url'] = "instructor/{$userId}/course_{$courseId}/poster.jpg";
        $data['trailer_url'] = "instructor/{$userId}/course_{$courseId}/trailer.mp4";
        $this->courseService->update($courseId, $data);

        return response()->json(['message' => __('messages.file.success.upload')]);
    }

    public function showCurriculum(int $id): View
    {
        $course = $this->courseService->getCourse($id);

        return view('instructor.course.curriculum', compact('course'));
    }

    public function getStudents(int $id): View
    {
        $enrollments = $this->courseService->getStudents($id);
        // dd($students);
        return view('instructor.course.students', compact('enrollments'));
    }
}
