<?php

namespace App\Http\Controllers;

use App\Actions\Post\NewCommentAction;
use App\Actions\Post\SearchAction;
use App\Http\Requests\Dashboard\NewCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\PostsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    private $posts;

    public function __construct(PostsRepository $posts)
    {
        $this->posts = $posts;
        $this->middleware('auth:sanctum')->only(['newComment']);
    }

    public function all()
    {
        return PostResource::collection($this->posts->all());
    }

    public function viewPost(Post $post)
    {
        return PostResource::make($post->load('author'), $post->loadCount('comments'));
    }

    public function comments(Post $post)
    {
        return CommentResource::collection($post->comments->load('parent.user'));
    }

    public function newComment(NewCommentRequest $request, Post $post, NewCommentAction $newCommentAction)
    {
        $newCommentAction->execute($request->user(), $post, $request->validated());
        return Response::success('New Comment successfully submitted!', 201);
    }

    public function getByCategory(Category $category)
    {
        return PostResource::collection($this->posts->getByCategory($category));
    }

    public function newest()
    {
        return PostResource::collection($this->posts->newest());
    }

    public function search(string $value, SearchAction $searchAction)
    {
        return $searchAction->execute($value);
    }
}
