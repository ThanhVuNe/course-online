<?php

namespace App\Services;

use App\Http\Requests\StoreTopicRequest;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TopicService
{
    /**
     * @var TopicRepositoryInterface
     */
    protected $topicRepo;

    public function __construct(TopicRepositoryInterface $topicRepo)
    {
        $this->topicRepo = $topicRepo;
    }

    /**
     * @param int $courseId
     * @return Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function getTopicsWithLessons($courseId)
    {
        return $this->topicRepo->getTopicsWithLessons($courseId);
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
