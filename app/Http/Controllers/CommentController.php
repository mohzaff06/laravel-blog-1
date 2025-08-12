<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request, Post $post)
    {
        try {
            $validated = $request->validate([
                'content' => 'required|max:1000|min:2|string',
            ]);

            $comment = Comment::create([
                'body' => $validated['content'],
                'post_id' => $request->post_id,
                'user_id' => $request->user()->id
            ]);

            $html = view('comments.show', compact('comment'))->render();
            return toastResponse('success', 'Comment created successfully!', statusCode: 201, extra: ['html' => $html]);
        } catch (ValidationException $e) {
            return toastResponse('error', $e->errors()->first(), 422);
        } catch (\Exception $e) {
            return toastResponse('error', 'An error occurred while creating the comment.', statusCode: 500);
        }
    }


    public function update(Request $request, Comment $comment)
    {
        // Check authorization
        if (!$request->user()->can('update', $comment)) {
            return toastResponse('error', 'You are not authorized to update this comment.', null, 403);
        }

        $validated = $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        $comment->update(['body' => $validated['body']]);

        // Force JSON response for API endpoints
        if (str_starts_with($request->path(), 'api/')) {
            return response()->json([
                'type' => 'success',
                'message' => 'Comment updated successfully.',
                'comment' => $comment->body
            ], 200);
        }

        return toastResponse(
            'success',
            'Comment updated successfully.',
            null,
            200,
            ['comment' => $comment->body]
        );
    }

    public function destroy(Comment $comment)
    {
        if ($comment->delete()) {
            return toastResponse('success', 'Comment deleted!');
        }

        return toastResponse('error', 'Failed to delete comment');
    }

    public function create(Post $post) {}
}
