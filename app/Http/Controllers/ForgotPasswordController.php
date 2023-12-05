<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Services\ResetPasswordService;
use App\Services\UserService;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var ResetPasswordService
     */
    protected $resetPasswordService;

    public function __construct(UserService $userService, ResetPasswordService $resetPasswordService)
    {
        $this->userService = $userService;
        $this->resetPasswordService = $resetPasswordService;
    }

    /**
     * @return View
     */
    public function showForgotPasswordForm(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * @param ForgotPasswordRequest $request
     * @return RedirectResponse
     */
    public function submitForgetPasswordForm(ForgotPasswordRequest $request)
    {
        $expireTime = 60;
        $lastEmailSentTime = $request->session()->get('last_email_sent_time');

        if ($lastEmailSentTime && now()->diffInSeconds($lastEmailSentTime) < $expireTime) {
            return redirect()->back()->with("error", __('messages.instructor.error.request'));
        }

        $email = $request->input('email');

        /**
         * Create a object for 'password_reset_token' table
         */
        $randomToken = Str::random(60);
        $expiryTime = now()->addMinutes(10)->toDateTimeString();

        $this->resetPasswordService->addResetPassWord(
            $email,
            $randomToken,
            $expiryTime
        );

        /**
         *Retrieve the token data again for the email address
         */
        $tokenData = $this->resetPasswordService->getByEmail($email);
        /**
         * Send password reset link to email
         */
        Mail::send("email.index", ['token' => $tokenData['token']], function ($message) use ($email) {
            $message->to($email);
            $message->subject("Reset Password");
        });

        $request->session()->put('last_email_sent_time', now());

        return redirect()->back()->with('message', __('messages.password.success.forgot_password'));
    }
}
