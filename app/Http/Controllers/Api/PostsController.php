<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(int|null $limit = null, int|null $start = null)
    {
        $query = Post::select('*');
        if (null !== $limit) {
            $query->limit($limit);
        }
        if (null !== $start) {
            $query->offset($start);
        }

        $posts = $query->get();
        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        return PostResource::make($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
    }
}
