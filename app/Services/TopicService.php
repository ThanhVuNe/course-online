<?php

namespace App\Services;

use App\Http\Requests\StoreTopicRequest;
use App\Repositories\Interfaces\AnswerRepositoryInterface;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\ResultRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TopicService
{
    /**
     * @var TopicRepositoryInterface
     */
    protected $topicRepo;

     /**
     * @var AnswerRepository
     */
    protected $answerRepo;

    protected $resultRepo;

    protected $questionRepo;

    public function __construct(
        TopicRepositoryInterface $topicRepo, 
        AnswerRepositoryInterface $answerRepo,
        ResultRepositoryInterface $resultRepo,
        QuestionRepositoryInterface $questionRepo
    )
    {
        $this->topicRepo = $topicRepo;
        $this->answerRepo = $answerRepo;
        $this->resultRepo = $resultRepo;
        $this->questionRepo = $questionRepo;
    }

    /**
     * @param int $courseId
     * @return Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function getTopicsWithLessons($courseId)
    {
        return $this->topicRepo->getTopicsWithLessons($courseId, (int)auth()->id());
    }

    public function getQuestions($topicId) {
        return $this->topicRepo->getQuestionsByTopic($topicId);
    }

    public function checkAnswers($answerIds) {
        $answers = $this->answerRepo->getAnswers($answerIds);
        $answersIcorrect = $answers->avg('is_correct');
        $averageIscorrectPercent = number_format($answersIcorrect * 100, 2);

        return ['answers' => $answers, 'average' => $averageIscorrectPercent, 'total_correct' => $answers->sum('is_correct')];
    }

    public function updateResult($data) {
        return $this->resultRepo->create($data);
    }

    public function getResultsByUser($userId) {
        return $this->resultRepo->getByUser($userId);
    }

    public function createQuestion($title, $topicId) {
        return $this->questionRepo->create(
            [
                'title' => $title,
                'topic_id' => $topicId
            ]
        );
    }

    public function insertMultipleAnswer($answers) {
        return $this->answerRepo->insertMultiple($answers);
    }
    /**
     * @param StoreTopicRequest $request
     * @return Model
     */
    public function create(StoreTopicRequest $request)
    {
        return $this->topicRepo->create($request->validated());
    }
}
