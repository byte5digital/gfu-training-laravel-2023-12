<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')
    ->name('profile.')
    ->prefix('/profile')
    ->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])
            ->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])
            ->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])
            ->name('destroy');
        Route::get('/{user}', [ProfileController::class, 'view'])
            ->name('view');
    });

require __DIR__.'/auth.php';

Route::name('blog.')
    ->prefix('/blog')
    ->group(function() {
        Route::get('/', [BlogController::class, 'index'])
            ->name('index');
        Route::get('/{post}', [BlogController::class, 'show'])
            ->name('show');

        Route::get('/create', [PostController::class, 'create'])
            ->name('create');
    });

Route::prefix('/posts')
    ->resource('posts', PostController::class);

