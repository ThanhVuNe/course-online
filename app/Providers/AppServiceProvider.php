<?php

namespace App\Providers;

use App\Enums\UserRoleEnum;
use App\Helpers\AmazonS3;
use App\Repositories\CourseRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\CartRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\EnrollmentRepository;
use App\Repositories\FavoriteRepository;
use App\Repositories\InstructorRepository;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\EnrollmentRepositoryInterface;
use App\Repositories\Interfaces\FavoriteRepositoryInterface;
use App\Repositories\Interfaces\InstructorRepositoryInterface;
use App\Repositories\Interfaces\LessonRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProfileRepositoryInterface;
use App\Repositories\Interfaces\ResetPasswordRepositoryInterface;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Repositories\Interfaces\SurveyRepositoryInterface;
use App\Repositories\Interfaces\TeacherProfileRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\LessonRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\ResetPasswordRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\SurveyRepository;
use App\Repositories\TeacherProfileRepository;
use App\Repositories\TopicRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->singleton(
            LessonRepositoryInterface::class,
            LessonRepository::class
        );

        $this->app->singleton(
            CourseRepositoryInterface::class,
            CourseRepository::class
        );
        $this->app->singleton(
            ReviewRepositoryInterface::class,
            ReviewRepository::class
        );

        $this->app->singleton(
            TopicRepositoryInterface::class,
            TopicRepository::class
        );
        $this->app->singleton(
            ProfileRepositoryInterface::class,
            ProfileRepository::class,
        );
        $this->app->singleton(
            CartRepositoryInterface::class,
            CartRepository::class,
        );
        $this->app->singleton(
            ResetPasswordRepositoryInterface::class,
            ResetPasswordRepository::class,
        );

        $this->app->singleton(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );

        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->singleton('AmazonS3', function () {
            return new AmazonS3();
        });

        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->singleton(
            EnrollmentRepositoryInterface::class,
            EnrollmentRepository::class
        );

        $this->app->singleton(
            SurveyRepositoryInterface::class,
            SurveyRepository::class
        );

        $this->app->singleton(
            FavoriteRepositoryInterface::class,
            FavoriteRepository::class
        );

        $this->app->singleton(
            InstructorRepositoryInterface::class,
            InstructorRepository::class
        );

        $this->app->singleton(
            TeacherProfileRepositoryInterface::class,
            TeacherProfileRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('instructor', function () {
            return auth()->check() && auth()->user()?->role_id == UserRoleEnum::Instructor;
        });
    }
}
