<?php

namespace App\Actions\Post\DashboardSection;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Response;

class NewBookmarkAction
{
    public function execute(User $user, Post $post)
    {
        $toggle = $user->posts()->toggle($post);
        $check = $toggle['attached'] ? 1 : 0;
        return Response::success($check);
    }
}
