<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * returns paginated list of all posts
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $posts = Post::recursive()->paginate(10);

        return view('blog.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Returns the post details page
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        return view('blog.post', ['post' => $post]);
    }
}
