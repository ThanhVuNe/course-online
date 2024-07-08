<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Services\LessonService;
use Illuminate\Http\Request;
use AmazonS3;
use App\Http\Requests\StoreLessonRequest;
use Dflydev\DotAccessData\Data;
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
    public function getUploadUrl(Request $request, $lessonId)
    {
        $userId = auth()->id();
        $lesson = $this->lessonService->findLessonInstructor($lessonId);
        $topicId = $lesson->topic_id;
        $fileType = $request->input('fileType');
        // dd($fileType);
        if (str_contains($fileType, 'video')) {
            $fileType = 'mp4';
        } else if ($fileType === 'application/pdf') {
            $fileType = 'pdf';
        }

        $pathVideo = "instructor/{$userId}/topic_{$topicId}/lesson_{$lessonId}.{$fileType}";
        return response()->json([
            'urlVideo' => AmazonS3::getPreSignedUploadUrl($pathVideo)
        ]);
    }

    /**
     * @param int $lessonId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUrl(Request $request, $lessonId)
    {
        $fileType = $request->input('fileType');
        $lessonDuration = $request->input('lessonDuration');
        if (strpos($lessonDuration, ':') == false) {
            $lessonDuration = '0'.$lessonDuration;
        } 
        if($lessonDuration == '') {
            $lessonDuration = null;
        }
        $data = [];
        $userId = auth()->id();
        $lesson = $this->lessonService->findLessonInstructor($lessonId);
        $topicId = $lesson->topic_id;
        
        if (str_contains($fileType, 'video')) {
            $fileType = 'mp4';
        } else if ($fileType === 'application/pdf') {
            $fileType = 'pdf';
        } 

        $data['lesson_url'] = "instructor/{$userId}/topic_{$topicId}/lesson_{$lessonId}.{$fileType}";
        $data['file_type'] = $fileType;
        $data['lesson_duration'] = $lessonDuration;

        $this->lessonService->update($lessonId, $data);

        return response()->json(['message' => __('messages.file.success.upload')]);
    }
}
