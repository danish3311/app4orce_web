<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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


//public routes
Route::get('/login', [AuthController::class, 'login_view'])->name('login_view');
Route::get('/register', [AuthController::class, 'register_view'])->name('register_view');
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/create', [PostController::class, 'create_view'])->name('create_view');
Route::get('posts/single/{id}', [PostController::class, 'single'])->name('posts.single');
Route::post('/signin', [AuthController::class, 'login'])->name('signin');
Route::post('/signup', [AuthController::class, 'register'])->name('signup');


//protected routes

Route::middleware(['auth.user'])->group(function () {
    Route::get('posts/create_post', [PostController::class, 'create_post']);
Route::get('posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
Route::post('posts', [PostController::class, 'create_post'])->name('create_post');
Route::post('posts/{id}/update', [PostController::class, 'update'])->name('posts.update');
Route::delete('posts/{id}/delete', [PostController::class, 'destroy'])->name('posts.destroy');
Route::post('/logout/{id}', [AuthController::class, 'logout'])->name('logout');


});
