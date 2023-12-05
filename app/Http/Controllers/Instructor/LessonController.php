<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Services\LessonService;
use Illuminate\Http\Request;
use AmazonS3;
use App\Http\Requests\StoreLessonRequest;
use Illuminate\Contracts\View\View;

class LessonController extends Controller
{
    /**
     * @var LessonService;
     */
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Lesson Create View
     *
     * @param int $courseId
     * @param int $topicId
     * @return view
     */
    public function create($courseId, $topicId)
    {
        return view('instructor.lesson.create', compact('topicId', 'courseId'));
    }

    /**
     * Function store lesson
     *
     * @param StoreLessonRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLessonRequest $request)
    {
        $data = $request->validated();
        $lesson = $this->lessonService->create($data);
        $lessonId = $lesson->id;

        return response()->json(['message' => __('message.file.success.upload'), 'lessonId' => $lessonId]);
    }

    /**
     * @param int $lessonId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUploadUrl($lessonId)
    {
        $userId = auth()->id();
        $lesson = $this->lessonService->findLesson($lessonId);
        $topicId = $lesson->topic_id;
        $pathVideo = "instructor/{$userId}/topic_{$topicId}/lesson_{$lessonId}.mp4";

        return response()->json([
            'urlVideo' => AmazonS3::getPreSignedUploadUrl($pathVideo)
        ]);
    }

    /**
     * @param int $lessonId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUrl($lessonId)
    {
        $data = [];
        $userId = auth()->id();
        $lesson = $this->lessonService->findLesson($lessonId);
        $topicId = $lesson->topic_id;
        $data['lesson_url'] = "instructor/{$userId}/topic_{$topicId}/lesson_{$lessonId}.mp4";
        $this->lessonService->update($lessonId, $data);

        return response()->json(['message' => __('messages.file.success.upload')]);
    }
}
