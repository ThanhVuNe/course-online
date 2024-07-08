<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Services\TopicService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TopicController extends Controller
{
    /**
     * @var TopicService;
     */
    protected $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }
    public function create(int $courseId): View
    {
        return view('instructor.topic.create', compact('courseId'));
    }

    /**
     * Function add one topic for one course
     * @param int $courseId
     * @param StoreTopicRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTopicRequest $request, $courseId)
    {
        if ($this->topicService->create($request)) {
            session()->flash('message', __('messages.topic.success.create'));
            return redirect()->route('instructor.courses.curriculum.show', compact('courseId'));
        }
        session()->flash('error', __('messages.topic.error.create'));

        return redirect()->back();
    }

    public function questions($courseId, $topicId) {
        $topic = $this->topicService->getQuestions($topicId);
        // dd($topic);
        return view('instructor.question.index', compact('topic', 'courseId'));
    }
}
