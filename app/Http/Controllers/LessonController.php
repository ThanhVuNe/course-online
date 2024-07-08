<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use App\Services\CourseService;
use App\Services\LessonService;
use App\Services\TopicService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * @var LessonService
     */
    protected $lessonService;

    /**
     * @var CourseService
     */
    protected $courseService;

    /**
     * @var TopicService
     */
    protected $topicService;

    /**
     * @var CommentService
     */
    protected $commentService;

    public function __construct(
        LessonService $lessonService,
        CourseService $courseService,
        TopicService $topicService,
        CommentService $commentService
    ) {
        $this->lessonService = $lessonService;
        $this->courseService = $courseService;
        $this->topicService = $topicService;
        $this->commentService = $commentService;
    }

    /**
     * @param int $courseId
     * @param int $lessonId
     * @return View
     */
    public function show(int $courseId, int $lessonId): View
    {
        $course = $this->courseService->findCourse($courseId);
        $lesson = $this->lessonService->findLesson($lessonId, auth()->id());
        $topics = $this->topicService->getTopicsWithLessons($courseId);
        $comments = $this->commentService->getByLesson($lessonId);
        // dd($topics);
        return view('lesson.index', compact('course', 'lesson', 'topics', 'comments'));
    }

    public function completedLesson(Request $request, $courseId, $lessonId)
    {
        // Check if the lesson process exists
        $this->lessonService->saveProcess($lessonId);
        $lessonByCourse = $this->lessonService->getLessonByCourse($courseId);

        $currentIndex = $lessonByCourse->search(function ($lesson) use ($lessonId) {
            return $lesson->id == $lessonId;
        });

        $nextLesson = $lessonByCourse[$currentIndex+1] ?? null;
        if($nextLesson) {
            return redirect()->route('courses.lessons.show', ['courseId' => $courseId, 'lessonId' => $nextLesson->id]);
        }

        return redirect()->route('courses.lessons.show', ['courseId' => $courseId, 'lessonId' => $lessonId]);
    }
}
