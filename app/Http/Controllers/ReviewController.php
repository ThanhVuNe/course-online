<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Services\ReviewService;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    /**
     * @var ReviewService
     */
    private $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    /**
     * Store a newly created resource in storage.
     * @return RedirectResponse
     */
    public function store(StoreReviewRequest $request): RedirectResponse
    {
        if ($this->reviewService->addReview($request)) {
            session()->flash('message', __('messages.review.success.create'));
            return redirect()->back();
        }
        session()->flash('error', __('messages.review.error.create'));

        return redirect()->back();
    }
}
