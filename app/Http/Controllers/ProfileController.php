<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use AmazonS3;
use App\Enums\ActiveUserEnum;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var ProfileService
     */
    protected $profileService;

    public function __construct(UserService $userService, ProfileService $profileService)
    {
        $this->userService = $userService;
        $this->profileService = $profileService;
    }

    /**
     * Get information about logged in user with id
     */
    public function show(): View
    {
        $user = $this->userService->getInfor(Auth::id());

        return view('user.profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $userId = auth()->id();

        $user = $request->only('username');
        $profile = $request->only('first_name', 'last_name', 'description');

        $this->userService->updateUser($userId, $user);
        $this->profileService->updateOrCreateProfile($userId, $profile);

        session()->flash('message', __('messages.profile.success.update'));

        return redirect()->route('users.profile');
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateImage()
    {
        $userId = auth()->id();
        $this->profileService->updateOrCreateProfile($userId, ['avatar' => "profile/{$userId}/avatar.jpg"]);

        return response()->json(['success' => __('messages.profile.success.update_image')]);
    }

    /**
     * Generate and return a pre-signed upload URL for a user's profile image.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUploadUrl()
    {
        $userId = auth()->id();
        $path = "profile/{$userId}/avatar.jpg";

        return response()->json(['url' => AmazonS3::getPreSignedUploadUrl($path)]);
    }

    /**
     * @param string $token
     *
     * @return RedirectResponse
     */
    public function activeUser($token)
    {
        $tokens = explode('.', $token);
        abort_if(($tokens[1] < now()), 419);

        /**
         * @var User
         */
        $user = $this->userService->findUser($token);
        $user['is_active'] = ActiveUserEnum::Active;
        $user->save();
        session()->flash('message', __('messages.user.verify_email.success'));

        return redirect()->route('login.show');
    }
}
