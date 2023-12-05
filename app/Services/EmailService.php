<?php

namespace App\Services;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailService
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param int $userId
     * @return string
     */
    public function expiredLink(int $userId): string
    {
        $confirmationUrl = URL::temporarySignedRoute(
            'users.comfirm',
            now()->addMinutes(10),
            ['id' => $userId]
        );

        return $confirmationUrl;
    }

    /**
     * @param string $email
     * @param string $username
     * @param string $confirmationUrl
     * @return void
     */
    public function sendEmail(string $email, string $username, string $confirmationUrl): void
    {
        Mail::send("email.register", ['confirmationUrl' => $confirmationUrl, 'username' => $username], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Instructor Registration');
        });
    }

    /**
     * @param int $userId
     * @param string $email
     * @param string $username
     *
     * @return void
     */
    public function verifyMail($userId, $email, $username): void
    {
        $token = md5($email) . '.' . (now()->addDays(1)->toDateTimeString());
        $data = [];
        $data['token_authentication'] = $token;
        $this->userService->updateUser($userId, $data);

        Mail::send("auth.verify-email", ['username' => $username, 'token' => $token], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Verify your email address');
        });
    }
}
