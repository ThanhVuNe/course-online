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
        $enrollments = $this->model->with('course.category:id,name')
            ->owner($userId)->paginate(self::PAGINATE_DEFAULT);
        foreach ($enrollments as $enrollment) {
            $completedLessonsCount = 0;
            $totalLessonsCount = 0;

            foreach ($enrollment->course->topics as $topic) {
                foreach ($topic->lessons as $lesson) {
                    // Check if the lesson is completed by the user
                    if ($lesson->processing->where('user_id', $userId)->count() > 0) {
                        $completedLessonsCount++;
                    }
                    $totalLessonsCount++;
                }
            }

            // Calculate the percentage progress
            if ($totalLessonsCount > 0) {
                $progress = ($completedLessonsCount / $totalLessonsCount) * 100;
            } else {
                $progress = 0; // Handle case where there are no lessons in the course
            }

            $enrollment->course->progress = $progress;
        }
        return $enrollments;
    }

    public function getUserProgress($courseId) {
        $enrollments = $this->model->where('course_id', $courseId)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach ($enrollments as $enrollment) {
            $completedLessonsCount = 0;
            $totalLessonsCount = 0;
    
            foreach ($enrollment->course->topics as $topic) {
                foreach ($topic->lessons as $lesson) {
                        // Check if the lesson is completed by the user
                    if ($lesson->processing->where('user_id', $enrollment->user_id)->count() > 0) {
                          $completedLessonsCount++;
                    }
                        $totalLessonsCount++;
                    }
                }
    
                // Calculate the percentage progress
                if ($totalLessonsCount > 0) {
                    $progress = ($completedLessonsCount / $totalLessonsCount) * 100;
                } else {
                    $progress = 0; // Handle case where there are no lessons in the course
                }
    
                $enrollment->progress = $progress;
            }

            return $enrollments;
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

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function getStudents($id)
    {
        return $this->model->where('course_id', $id)->with(['user.profile'])->get();
    }


    /**
     * @param int $id
     * @return LengthAwarePaginator<Model>
     */
    public function getInstructorCoursesRecent($id): LengthAwarePaginator
    {
        return $this->model->whereHas('course', function ($query) use ($id) {
            $query->where('instructor_id', $id);
        })
        ->with('user')
        ->orderBy('created_at', 'DESC')
        ->paginate(10);
    }
}
