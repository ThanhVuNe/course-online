<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
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

     public function create(Request $request)
    {
        $comment = $this->commentService->create([
            'user_id' => auth()->id(),
            'lesson_id' => $request->lesson_id,
            'content' => $request->content, // Get the content from the request
            'parent_id' => $request->parent_id
        ]);

        if ($comment) {
            return response()->json(['message' => __('messages.comment.success.create'), 'code' => 200], 200);
        }

        return response()->json(['message' => __('messages.comment.error.create'), 'code' => 400], 400);
    }

    /**
     * @param UpdateCommentRequest $request
     * @param int $commentId
     *
     * @return JsonResponse
     */
    public function update(UpdateCommentRequest $request, int $commentId)
    {
        if ($this->commentService->update($commentId, (int) auth()->id(), $request->content)) {
            return response()->json(['message' =>  __('messages.comment.success.update'), 'code' => 200], 200);
        }

        return response()->json(['message' =>  __('messages.comment.error.update'), 'code' => 400], 400);
    }

    /**
     * @param DeleteCommentRequest $request
     * @param int $id
     *
     * @return JsonResponse
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function destroy(DeleteCommentRequest $request, int $id)
    {
        if ($this->commentService->delete($id, (int) auth()->id())) {
            return response()->json(['message' =>  __('messages.comment.success.delete'), 'code' => 200], 200);
        }

        return response()->json(['message' =>  __('messages.comment.error.delete'), 'code' => 400], 400);
    }
}
