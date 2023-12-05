<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\DeleteCommentRequest;
use App\Services\CommentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @var CommentService
     */
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * @param StoreCommentRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreCommentRequest $request): RedirectResponse
    {
        if ($this->commentService->create($request)) {
            session()->flash('message', __('messages.comment.success.create'));
            return redirect()->back();
        }
        session()->flash('error', __('messages.comment.error.create'));

        return redirect()->back();
    }
}
