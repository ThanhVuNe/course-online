<?php

namespace App\Services;

use App\Repositories\Interfaces\LessonRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LessonService
{
    /**
     * @var lessonRepositoryInterface
     */
    protected $lessonRepo;

    public function __construct(LessonRepositoryInterface $lessonRepo)
    {
        $this->lessonRepo = $lessonRepo;
    }

    /**
     * @param int $lessonId
     * @return Model
     */
    public function findLesson($lessonId)
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
}
