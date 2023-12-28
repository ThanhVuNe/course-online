<?php

namespace App\Http\Controllers;

use App\Enums\ActiveUserEnum;
use App\Http\Requests\LoginRequest;
use App\Services\EmailService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @var EmailService
     */
    protected $emailService;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var int
     */
    protected $attemptsDefault = 0;

    /**
     * @var int
     */
    protected $maxAttempts = 5;

    /**
     * @var array
     */
    protected $user = [];

    public function __construct(EmailService $emailService, UserService $userService)
    {
        $this->emailService = $emailService;
        $this->userService = $userService;
    }

    public function show(): View
    {
        return view('auth.login');
    }

    /**
     * Login and redirect.
     *
     * @return RedirectResponse
     */
    public function auth(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            if (auth()->user()?->is_active == ActiveUserEnum::Active) {
                $request->session()->regenerate();
                $this->user['login_attempts'] = $this->attemptsDefault;
                $this->userService->updateUser(auth()->id(), $this->user);

                return redirect()->route('home');
            }
            session()->flash('error', __('messages.user.error.block'));

            if (auth()->user()?->login_attempts < $this->maxAttempts) {
                $userId = (int) auth()->id();
                $email = (string) auth()->user()?->email;
                $username = (string) auth()->user()?->username;
                $this->emailService->verifyMail($userId, $email, $username);
                session()->flash('error', __('messages.user.error.active'));
            }
            auth()->logout();

            return redirect()->back()->withInput();
        }

        session()->flash('error', __('messages.user.error.login'));
        if ($this->userService->checkLoginAttempts($request->email)) {
            session()->flash('error', __('messages.user.error.block'));
        }

        return redirect()->back()->withInput();
    }

    /**
     * Logout and redirect.
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->logout();
        session()->flush();

        return redirect()->route('home');
    }

    /**
     * @return View
     */
    public function survey()
    {
        return view('common.survey');
    }
}
