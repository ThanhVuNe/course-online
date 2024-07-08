<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\CourseService;
use App\Services\LessonService;
use App\Services\SurveyService;
use App\Services\TopicService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TopicController extends Controller
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
        TopicService $topicService
    ) {
        $this->lessonService = $lessonService;
        $this->courseService = $courseService;
        $this->topicService = $topicService;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function showQuestion($courseId, $topicId): View
    {
        $course = $this->courseService->findCourse($courseId);
        $topics = $this->topicService->getTopicsWithLessons($courseId);
        $questions = $this->topicService->getQuestions($topicId);

        return view('lesson.show', compact('course', 'topics', 'questions'));
    }

    public function submitQuestion(Request $request, $courseId, $topicId) {
        $data = $request->post();
        array_shift($data);
        $answers = $this->topicService->checkAnswers(array_values($data));
    
        $this->topicService->updateResult([
            'user_id' => auth()->id(),
            'topic_id' => $topicId,
            'correct' => $answers['total_correct']
        ]);

        $result = $this->topicService->getResultsByUser(auth()->id());

        $course = $this->courseService->findCourse($courseId);
        $topics = $this->topicService->getTopicsWithLessons($courseId);

        $nextTopic = $topics->filter(function ($topic) use ($topicId) {
            return $topic->id > $topicId;
        })->first();
    
        // dd($nextTopics);
        return view('lesson.result',  compact('course', 'topics', 'answers', 'nextTopic', 'result'));
    }

    public function results($courseId, $topicId) {
        $result = $this->topicService->getResultsByUser(auth()->id());

        $course = $this->courseService->findCourse($courseId);
        $topics = $this->topicService->getTopicsWithLessons($courseId);
        $nextTopic = $topics->filter(function ($topic) use ($topicId) {
            return $topic->id > $topicId;
        })->first();

        return view('lesson.result',  compact('course', 'topics','nextTopic', 'result'));
    }
}
