<?php

namespace App\Repositories;

use App\Models\Enrollment;
use App\Repositories\Interfaces\EnrollmentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class EnrollmentRepository extends BaseRepository implements EnrollmentRepositoryInterface
{
    protected const PAGINATE_DEFAULT = 15;

    public function getModel()
    {
        return Enrollment::class;
    }

    /**
     * @param int $userId
     *
     * @return LengthAwarePaginator<Enrollment>
     */
    public function getMyCoures($userId): LengthAwarePaginator
    {
        /** @phpstan-ignore-next-line */
        return $this->model->with('course.category:id,name')
            ->owner($userId)->paginate(self::PAGINATE_DEFAULT);
    }

    /**
     * @param int $userId
     * @param int $courseId
     *
     * @return int
     */
    public function isEnrolled($userId, $courseId)
    {
        /** @phpstan-ignore-next-line */
        return $this->model->owner($userId)->where('course_id', $courseId)->get()->count();
    }
}
