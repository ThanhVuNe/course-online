<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileInstructorRequest;
use App\Services\LessonService;
use App\Services\TeacherProfileService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @var UserService;
     */
    protected $userService;

    protected $teacherProfileService;

    public function __construct(UserService $userService, TeacherProfileService $teacherProfileService)
    {
        $this->userService = $userService;
        $this->teacherProfileService = $teacherProfileService;
    }

    /**
     * Lesson Create View
     *
     * @return view
     */
    public function index()
    {
        $user = $this->userService->getInforInstructor(auth()->id());
    
        return view('instructor.profile.index', compact('user'));
    }

    public function update(UpdateProfileInstructorRequest $request)
    {
        if($this->teacherProfileService->updateOrCreate($request->validated())){
            session()->flash('message', __('messages.instructor.success.profile.update'));
            return redirect()->route('instructor.profile.index');
        }

        session()->flash('message', __('messages.instructor.error.profile.update'));

        return redirect()->route('instructor.profile.index');
    }
}
