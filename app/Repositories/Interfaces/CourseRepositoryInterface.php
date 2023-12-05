<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\GetCoursesRequest;
use App\Repositories\RepositoryInterface;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface CourseRepositoryInterface extends RepositoryInterface
{
    /**
     * @param GetCoursesRequest $request
     * @return LengthAwarePaginator<Course>
     */
    public function getCourses($request): LengthAwarePaginator;

    /**
     * Sum totalStudent in course by instructor
     *
     * @param int $instructorId
     * @param int $courseId
     * @param string $startDate
     * @param string $endDate
     * @param string $type
     * @return Collection
     */
    public function totalStudentsByTime($instructorId, $courseId, $startDate, $endDate, $type): Collection;

    /**
     * @param Carbon|false $startDate.
     * @param Carbon|false $endDate
     * @param string $dateFormat
     * @param int $instructorId
     * @param int $courseId
     *
     * @return Collection
     */
    public function getCourseRevenueStatistics($startDate, $endDate, $dateFormat, $instructorId, $courseId): Collection;

    /**
     * @param int $id
     * @return LengthAwarePaginator<Model>
     */
    public function getInstructorCourses($id): LengthAwarePaginator;

    /**
     * @param array $courseIds
     * @return int
     */
    public function addStudentInCourse($courseIds);

    /**
     * @param array $courseIds
     * @return float
     */
    public function getTotalPriceOfCourses($courseIds);

    /**
     * @param array $categoryIds
     * @param string $language
     * @param string $level
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recommnedCourse($categoryIds, $language, $level);
}
