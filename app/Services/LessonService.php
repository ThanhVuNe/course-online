<?php

namespace App\Services;

use App\Repositories\Interfaces\LessonRepositoryInterface;
use App\Repositories\Interfaces\ProcessingRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LessonService
{
    /**
     * @var lessonRepositoryInterface
     */
    protected $lessonRepo;

    /**
     * @var ProcessingRepositoryInterface
     */
    protected $proRepo;
    public function __construct(LessonRepositoryInterface $lessonRepo, ProcessingRepositoryInterface $proRepo)
    {
        $this->lessonRepo = $lessonRepo;
        $this->proRepo = $proRepo;
    }

    /**
     * @param int $lessonId
     * @return Model
     */
    public function findLesson($lessonId, $userId)
    {
        return $this->lessonRepo->getLessonByProcessing($lessonId, $userId);
    }

     /**
     * @param int $lessonId
     * @return Model
     */
    public function findLessonInstructor($lessonId)
    {
        return $this->lessonRepo->findOrFail($lessonId);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create($data)
    {
        return $this->lessonRepo->create($data);
    }

    /**
     * @param int $lessonId
     * @param array $data
     * @return int|bool|Model
     */
    public function update($lessonId, $data)
    {
        return $this->lessonRepo->update($lessonId, $data);
    }

    public function saveProcess($lessonId)
    {
        if(!$this->proRepo->checkExist(auth()->id(), $lessonId)) {
            $this->proRepo->create([
                'user_id' => auth()->id(),
                'lesson_id' => $lessonId
            ]);
        }
    }

    public function getLessonByCourse($courseId)
    {
        return $this->lessonRepo->getLessonByCourse($courseId);
    }
}
