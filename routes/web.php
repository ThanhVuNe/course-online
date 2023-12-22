<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Instructor\CourseController as InstructorCourseController;
use App\Http\Controllers\Instructor\HomeController as InstructorHomeController;
use App\Http\Controllers\Instructor\LessonController as InstructorLessonController;
use App\Http\Controllers\Instructor\TopicController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VNPayController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\Instructor\RegisterController as InstructorRegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('profile', [ProfileController::class, 'show'])->name('profile');
        Route::put('profile', [ProfileController::class, 'update'])->name('update');
        Route::put('profile/image', [ProfileController::class, 'updateImage'])->name('updateImage');
        Route::get('profile/getUploadUrl', [ProfileController::class, 'getUploadUrl'])->name('getUploadUrl');
        Route::get('my-courses', [CourseController::class, 'getMyCourses'])->name('my-courses');
        Route::get('my-favorites', [CourseController::class, 'getMyFavorites'])->name('my-favorites');
        Route::get('survey-form', [LoginController::class, 'survey'])->name('survey-form');
        Route::get('register', [InstructorRegisterController::class, 'index'])->name('register');
        Route::post('send-mail', [InstructorRegisterController::class, 'submitRegisterForm'])->name('sendMail');
        Route::get('comfirm-instructor/{id}', [InstructorRegisterController::class, 'updateRole'])->name('comfirm')->middleware('signed');
    });
    Route::post('toggle-favorite/{courseId}', [CourseController::class, 'toggleFavorite'])->name('toggle-favorite');
    Route::resource('comments', CommentController::class)->only(['store']);
    Route::resource('reviews', ReviewController::class)->only(['store']);
    Route::resource('carts', CartController::class)->only(['index', 'store']);
    Route::delete('carts/delete-cart', [CartController::class, 'deleteMutilCarts'])->name('carts.delete-cart');
    Route::delete('carts/{id}', [CartController::class, 'destroy'])->name('carts.destroy');
    Route::resource('checkouts', CheckoutController::class)->only(['index', 'store']);
    Route::resource('orders', OrderController::class)->only(['index', 'store']);

    Route::controller(PaypalController::class)->prefix('paypal')->name('paypal.')
        ->group(function () {
            Route::get('handle', 'handlePayment')->name('payment');
            Route::get('success', 'afterPayment')->name('after');
        });

    Route::resource('surveys', SurveyController::class)->only(['index', 'store']);
    //admin and instructor can access
    Route::middleware(['instructor'])->group(function () {
        Route::prefix('instructor')->name('instructor.')->group(function () {
            Route::get('/', [InstructorHomeController::class, 'home'])->name('home');

            Route::resource('courses', InstructorCourseController::class);
            Route::get('courses/create/upload-file/{courseId}', [InstructorCourseController::class, 'upload'])->name('courses.upload');
            Route::get('courses/create/getUploadUrl/{courseId}', [InstructorCourseController::class, 'getUploadUrl'])->name('courses.getUrl');
            Route::put('courses/create/updateUrl/{courseId}', [InstructorCourseController::class, 'updateUrl'])->name('courses.updateUrl');
            Route::get('courses/create/upload-file/{courseId}', [InstructorCourseController::class, 'upload'])->name('courses.upload');
            Route::get('courses/{courseId}/curriculum', [InstructorCourseController::class, 'showCurriculum'])->name('curriculum.show');
            Route::get('/courses/{courseId}/curriculum/topics/create', [TopicController::class, 'create'])
                ->name('topics.create');
            Route::post('/courses/{courseId}/curriculum/topics', [TopicController::class, 'store'])->name('topics.store');
            Route::get('/courses/{courseId}/topics/{topicId}/lessons/create', [InstructorLessonController::class, 'create'])->name('lessons.create');
            Route::post('/lessons', [InstructorLessonController::class, 'store'])->name('lessons.store');
            Route::get('/lessons/getUploadUrl/{lessonId}', [InstructorLessonController::class, 'getUploadUrl'])->name('lessons.getUrl');
            Route::put('/lessons/updateUrl/{lessonId}', [InstructorLessonController::class, 'updateUrl'])->name('lessons.updateUrl');

            Route::get('courses/{courseId}/students/', [InstructorCourseController::class, 'getStudents'])->name('courses.students');
        });
    });

    //only admin can access
    Route::middleware(['admin'])->group(function () {
        //route for admin
    });
});

Route::middleware(['guest'])->group(function () {
    Route::prefix('login')->name('login.')->group(function () {
        Route::get('show', [LoginController::class, 'show'])->name('show');
        Route::post('auth', [LoginController::class, 'auth'])->name('auth');
    });

    Route::prefix('register')->name('register.')->group(function () {
        Route::get('show', [RegisterController::class, 'show'])->name('show');
        Route::post('store', [RegisterController::class, 'store'])->name('store');
    });

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'submitResetPasswordForm'])->name('password.update');
});
Route::get('/verify-email/{token}', [ProfileController::class, 'activeUser'])->name('verify-email');
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::resource('courses', CourseController::class)->only(['index', 'show']);

Route::resource('checkouts', CheckoutController::class)->only(['index', 'store']);

Route::resource('orders', OrderController::class)->only(['index', 'store']);

Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('{courseId}/lessons/{lessonId}', [LessonController::class, 'show'])->name('lessons.show')->middleware('verifyUserAccessCourse');
});

Route::get('/payments/vn-pay', [VNPayController::class,'index'])->name('vnPay.payment');
Route::get('/payments/vn-pay/process', [VNPayController::class,'processPaymentAndOrder'])->name('vnPay.processPaymentAndOrder');
