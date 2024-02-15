<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LogoutAction;
use App\Actions\Post\DashboardSection\NewBookmarkAction;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function user(Request $request)
    {
        return UserResource::make($request->user());
    }

    public function bookMarks(Request $request)
    {
        return PostResource::collection($request->user()->posts);
    }

    public function newBookmarks(Request $request, Post $post, NewBookmarkAction $newBookmarkAction)
    {
        return $newBookmarkAction->execute($request->user(), $post);
    }

    public function logout(Request $request, LogoutAction $logoutAction)
    {
        $logoutAction->execute($request->user());
        return Response::success('Successfully logged out.');
    }
}
