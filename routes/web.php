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

        // Tokens
        Route::prefix('/token')
            ->name('token.')
            ->group(function() {
                Route::get('create', [ProfileController::class, 'createToken'])
                    ->name('create');
                Route::prefix('/{token}')
                    ->group(function() {
                        Route::get('/refresh', [ProfileController::class, 'refreshToken'])
                            ->name('refresh');
                        Route::get('/destroy', [ProfileController::class, 'destroyToken'])
                            ->name('destroy');
                });
            });
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
