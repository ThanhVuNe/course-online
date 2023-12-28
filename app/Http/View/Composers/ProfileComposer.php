<?php

namespace App\Http\View\Composers;

use App\Services\ProfileService;
use Illuminate\View\View;

class ProfileComposer
{
    /**
     * @var ProfileService
     */
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $profile = null;
        if(auth()->check()) {
            $profile = $this->profileService->findUser(auth()->id());
        }

        $view->with('profile', $profile);
    }
}
