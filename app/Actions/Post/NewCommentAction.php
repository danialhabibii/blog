<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\User;

class NewCommentAction
{
    public function execute(User $user, Post $post, array $data): void
    {
        $post->comments()->create([
            'user_id' => $user->id,
            'body' => $data['body'],
            'commentable_id' => $post->id,
            'commentable_type' => get_class($post),
        ]);
    }
}
