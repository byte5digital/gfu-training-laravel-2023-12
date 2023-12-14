<?php

use App\Http\Controllers\Api\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

#Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
#    return $request->user();
#});

Route::get('posts', [PostsController::class, 'index'])
    ->name('posts.index');
Route::get('posts/limit/{limit}', [PostsController::class, 'index']);
Route::get('posts/limit/{limit}/start/{start}', [PostsController::class, 'index']);

Route::get('posts/{post:id}', [PostsController::class, 'show'])
    ->name('posts.show');

Route::delete('posts/{post:id}', [PostsController::class, 'destroy'])
    ->name('posts.destroy');

#Route::apiResource('posts', PostsController::class);
