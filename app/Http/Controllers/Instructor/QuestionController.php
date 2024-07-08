<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Services\TopicService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * @var TopicService;
     */
    protected $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }
    public function create(int $topicId): View
    {
        return view('instructor.question.create', compact('topicId'));
    }

    /**
     * Function add one topic for one course
     * @param int $courseId
     * @param StoreTopicRequest $request
     * @return RedirectResponse
     */
    public function store(Request $request, $topicId)
    {
        // dd($request->all());
        $title = $request->input('title');
        $answers = $request->input('answers');
        $correctAnswerIndex = $request->input('correct_answer');
        $answersInsert = [];

        try {
            DB::beginTransaction();
            $question = $this->topicService->createQuestion($title, $topicId);
            foreach ($answers as $index => $answer) {
                $isCorrect = $index == $correctAnswerIndex ? 1 : 0;
                $answersInsert[] = [
                    'question_id' => $question->id,
                    'title' => $answer,
                    'is_correct' => $isCorrect
                ];
            }
            $this->topicService->insertMultipleAnswer($answersInsert);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            session()->flash('error', __('messages.question.error.create'));
            return redirect()->back();
        }
        session()->flash('message', __('messages.question.success.create'));
        $courseId = 1;
        return redirect()->route('instructor.topic.questions', compact('courseId','topicId'));
    }

    public function createAnswer($questionId)
    {

        return view('instructor.answer.index', compact('questionId'));
    }
}
