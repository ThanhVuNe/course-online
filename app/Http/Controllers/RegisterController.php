<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\EmailService;
use App\Services\ProfileService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var ProfileService
     */
    protected $profileService;

    /**
     * @var EmailService
     */
    protected $emailService;

    public function __construct(UserService $userService, ProfileService $profileService, EmailService $emailService)
    {
        $this->userService = $userService;
        $this->profileService = $profileService;
        $this->emailService = $emailService;
    }

    public function show(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = $this->userService->create($request->validated());

        if ($user instanceof User) {
            $this->profileService->create($user->id);
        }

        $this->emailService->verifyMail($user->id, $user->email, $user->username);

        session()->flash('message', __('messages.user.success.create'));
        return redirect()->route('login.show');
    }
}
