<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use App\Services\EmailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * @var userService
     */
    protected $userService;

    /**
     * @var emailService
     */
    protected $emailService;

    public function __construct(UserService $userService, EmailService $emailService)
    {
        $this->userService = $userService;
        $this->emailService = $emailService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $user = $this->userService->getInfor(auth()->id());

        return view('user.register', compact('user'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function submitRegisterForm(Request $request): RedirectResponse
    {
        /** @var User */
        $user = auth()->user();
        $userId = $user->id;
        $email = $user->email;
        $userName = $user->username;

        $expireTime = 60;
        $lastEmailSentTime = $request->session()->get('last_email_sent_time');
        if ($lastEmailSentTime && now()->diffInSeconds($lastEmailSentTime) < $expireTime) {
            session()->flash('error', __('messages.instructor.error.request'));

            return redirect()->back();
        }

        $confirmationUrl = $this->emailService->expiredLink($userId);

        $this->emailService->sendEmail($email, $userName, $confirmationUrl);

        $request->session()->put('last_email_sent_time', now());

        session()->flash('message', __('messages.instructor.success.send'));

        return redirect()->back();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function updateRole($id): RedirectResponse
    {
        if ($this->userService->findRoleInstructor($id)) {
            session()->flash('message', __('messages.instructor.error.register'));

            return redirect()->back();
        }

        $this->userService->updateRole($id);
        session()->flash('message', __('messages.instructor.success.register'));

        return redirect()->back();
    }
}
