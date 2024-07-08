<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\Enrollment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyUserAccessCourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $courseId = $request->route('courseId');

        // Validate courseId is number and > 0
        if (!is_numeric($courseId) || $courseId <= 0) {
            return redirect()->route('courses.index');
        }

        // Validate course is active
        // $course = Course::where('id', $courseId)->where('is_active', true)->first();

        // if (!$course) {
        //     return redirect()->route('courses.show', ['course' => $courseId]);
        // }

        // Verify whether the user has participated in the course or not
        // dd(auth()->id());
        $enrollment = Enrollment::where('course_id', $courseId)
            ->where('user_id', auth()->id())
            ->first();

        if (!$enrollment) {
            return redirect()->route('courses.show', ['course' => $courseId]);
        }

        return $next($request);
    }
}
