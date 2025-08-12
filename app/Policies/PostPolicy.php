<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function update(User $user, Post $post): bool
    {
        return $post->user->is($user);
    }

    public function delete(User $user, Post $post): bool
    {
        return $post->user->is($user) || $user->isAdmin();
    }

    public function restore(User $user, Post $post): bool
    {
        return false;
    }


    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}
