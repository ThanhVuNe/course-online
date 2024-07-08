<?php

namespace App\Repositories;

use App\Http\Requests\GetCoursesRequest;
use App\Models\Course;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    protected const PAGESIZE = 10;

    public function getModel(): string
    {
        return Course::class;
    }

    /**
     * Retrieve a paginated list of courses based on the provided filters.
     *
     * @param GetCoursesRequest $request
     * @return LengthAwarePaginator<Course>
     */
    public function getCourses($request): LengthAwarePaginator
    {
        $courses = Course::with(['category','user.profile','favorites'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->filterBySearchTerm($request->input('search'));
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->filterByCategory($request->input('category'));
            })
            ->when($request->filled('rating'), function ($query) use ($request) {
                $query->filterByRating($request->input('rating'));
            })
            ->when($request->filled('language'), function ($query) use ($request) {
                $query->filterByLanguage($request->input('language'));
            })
            ->when($request->filled('level'), function ($query) use ($request) {
                $query->filterByLevel($request->input('level'));
            })
            ->when($request->filled('price'), function ($query) use ($request) {
                $query->filterByPrice($request->input('price'));
            })
            ->when($request->filled('duration'), function ($query) use ($request) {
                $query->filterByDuration($request->input('duration'));
            });

        if ($request->filled('sort')) {
            list($sortField, $sortType) = explode(':', $request->input('sort'));
            $courses->orderBy($sortField, $sortType);
        }

        $courses->orderBy('created_at', 'DESC');

        return $courses->paginate(self::PAGESIZE);
    }

    public function getCourseLatest()
    {
        return $this->model->with(['category','user.profile'])
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
    }

    /**
     * @param int $id
     * @return LengthAwarePaginator<Model>
     */
    public function getInstructorCourses($id): LengthAwarePaginator
    {
        return $this->model->with('category:id,name')->where('instructor_id', $id)->paginate(self::PAGESIZE);
    }

    /**
     * @param int $id
     * @return LengthAwarePaginator<Model>
     */
    public function getInstructorCoursesRecent($id): LengthAwarePaginator
    {
        return $this->model->with('enrollments.user')
            ->where('instructor_id', $id)
            ->paginate(self::PAGESIZE);
    }

    /**
     * Find a record by its primary key.
     *
     * @param int $id The primary key value.
     * @return Model
     */
    public function findOrFail($id): Model
    {
        return $this->model->with(['category:id,name', 'topics.lessons:id,topic_id,title'])->findOrFail($id);
    }

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
    public function totalStudentsByTime($instructorId, $courseId, $startDate, $endDate, $type): Collection
    {
        return $this->model->join('enrollments as e', 'courses.id', '=', 'e.course_id')
            ->selectRaw($type . ' as enrollment_date, COUNT(*) as total_student')
            ->where('courses.instructor_id', $instructorId)
            ->when(isset($courseId), function ($query) use ($courseId) {
                return $query->where('courses.id', $courseId);
            })
            ->whereBetween('e.created_at', [$startDate, $endDate])
            ->groupBy('enrollment_date')
            ->orderBy('enrollment_date')->get();
    }

    /**
     * @param Carbon|false $startDate.
     * @param Carbon|false $endDate
     * @param string $dateFormat
     * @param int $instructorId
     * @param int $courseId
     *
     * @return Collection
     */
    public function getCourseRevenueStatistics($startDate, $endDate, $dateFormat, $instructorId, $courseId): Collection
    {
        $orderStatusSuccess = 2;

        return $this->model::selectRaw('DATE_FORMAT(orders.created_at, ?) AS date_order, SUM(orders.price) AS total_price')
            ->join('orders', 'orders.course_id', '=', 'courses.id')
            ->where('orders.status', $orderStatusSuccess)
            ->when($instructorId, function ($query) use ($instructorId) {
                return $query->where('courses.instructor_id', $instructorId);
            })
            ->when($courseId, function ($query) use ($courseId) {
                return $query->where('courses.id', $courseId);
            })
            ->when(isset($startDate) && isset($endDate), function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('orders.created_at', [$startDate, $endDate]);
            })
            ->groupBy('date_order')
            ->addBinding($dateFormat, 'select')
            ->get();
    }

    /**
     * @param array $courseIds
     * @return int
     */
    public function addStudentInCourse($courseIds)
    {
        return $this->model->whereIn('id', $courseIds)->increment('total_students');
    }

    /**
     * @param array $courseIds
     * @return float
     */
    public function getTotalPriceOfCourses($courseIds)
    {
        $result = $this->model->whereIn('id', $courseIds)
            ->selectRaw('SUM(price * (100 - discount) / 100) as total_price')
            ->first();

        if (!$result) {
            return 0;
        }

        return $result->total_price;
    }

    /**
     * @param array $categoryIds
     * @param string $language
     * @param string $level
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recommnedCourse($categoryIds, $language, $level)
    {
        return $this->model->with('category')
            ->where(function ($query) use ($categoryIds, $language, $level) {
                $query->whereIn('category_id', $categoryIds)
                    ->orWhere('languages', $language)
                    ->orWhere('level', $level);
            })
            ->inRandomOrder()
            ->take(self::PAGESIZE)
            ->get();
    }


   /**
     * @param int $id
     * @return Model
     */
    public function getCourse($id)
    {
        return $this->model->with('user.profile')->findOrFail($id);
    }
}
