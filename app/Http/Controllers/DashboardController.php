<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(10)->get();

        return view('dashboard.index', compact('posts'));
    }
}
