<?php

namespace App\Console\Commands;

use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckLessonChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-update-lesson';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email for user talking the course if lesson is addded';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $startTime = Carbon::now()->subDay();
        $endTime = Carbon::now();
        Lesson::whereBetween('created_at', [$startTime, $endTime])
            ->with(['topic.course.enrollments.user'])
            ->chunk(100, function ($newLessonsAndEnrollments) {
                foreach ($newLessonsAndEnrollments as $lesson) {
                    // Lấy ra những user đăng kí khóa học
                    $enrollments = $lesson->topic->course->enrollments ?? [];
                    foreach ($enrollments as $enrollment) {
                        // Lấy thông tin người học
                        $user = $enrollment->user;

                        Mail::send(
                            'email.courses.create_lesson',
                            ['user' => $user, 'lesson' => $lesson],
                            function ($message) use ($user) {
                                $message->to($user?->email)
                                    ->subject('Course Update Notification');
                            }
                        );
                    }
                }
            });
    }
}
