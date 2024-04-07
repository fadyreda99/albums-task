<?php

use App\Http\Controllers\Albums\AlbumController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


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

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::prefix('albums')->group(function () {
        Route::get('/', [AlbumController::class, 'index'])->name('albums');
        Route::get('/create', [AlbumController::class, 'create'])->name('album.create');
        Route::post('/store', [AlbumController::class, 'store'])->name('album.store');
        Route::get('/edit/{album_id}', [AlbumController::class, 'edit'])->name('album.edit');
        Route::delete('/delete-image', [AlbumController::class, 'deleteImage'])->name('album.image.delete');
        Route::delete('/delete', [AlbumController::class, 'deleteAlbum'])->name('album.delete');
        Route::put('/update', [AlbumController::class, 'update'])->name('album.update');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
