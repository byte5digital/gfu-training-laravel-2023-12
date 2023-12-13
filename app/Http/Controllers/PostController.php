<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new post.
     */
    public function create(): View
    {
        return view('posts.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $postCreated = (new Post)
            ->fill($request->validated())
            ->syncTagsFromString($request->validated('tags'))
            ->save();

        if ( ! $postCreated) {
            return redirect(route('posts.create'))
                ->with('error', __('Unable to create post!'));
        }

        return redirect(route('blog.index'))
            ->with('success', __('Post successfully updated!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('posts.form', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post): Application|Redirector|RedirectResponse
    {
        $postUpdated = $post->fill($request->validated())
            ->syncTagsFromString($request->validated('tags'))
            ->update();

        if ( ! $postUpdated) {
            return redirect(route('posts.edit', ['post' => $post]))
                ->with('error', __('Unable to update post ":post"!', ['post' => $post]));
        }

        return redirect(route('blog.index'))
            ->with('success', __('Post ":post" updated successfully!', ['post' => $post]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): Application|Redirector|RedirectResponse
    {
        $redirection = redirect(route('blog.index'));

        if ( ! $post->delete()) {
            return $redirection
                ->with('error', __('Unable to destroy Post ":post"!', ['post' => $post]));
        }

        return $redirection
            ->with('success', __('Post ":post" destroyed successfully!', ['post' => $post]));
    }
}
