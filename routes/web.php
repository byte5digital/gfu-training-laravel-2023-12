<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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
        Route::get('/token/create', [ProfileController::class, 'createToken'])
            ->name('token.create');
    });

require __DIR__.'/auth.php';

$allowedForGuests = ['index', 'show'];
Route::middleware('auth')->group(function() use($allowedForGuests) {
    Route::resource('posts', PostController::class, [
        'except' => $allowedForGuests,
    ]);
});
Route::resource('posts', PostController::class, [
    'only' => $allowedForGuests,
]);
