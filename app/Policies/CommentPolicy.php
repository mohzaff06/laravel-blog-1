<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{

    public function update(User $user, Comment $comment): bool
    {
        return $comment->user->is($user);
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $comment->user->is($user) || $comment->post->user->is($user) || $user->isAdmin();
    }


    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Comment $comment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Comment $comment): bool
    {
        return false;
    }
}
