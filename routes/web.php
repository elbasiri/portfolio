<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function () {

 
            Route::post('/comments/{id}/like', [CommentController::class, 'like'])->name('comment.like');    
        Route::post('/comment', [HomeController::class,'store'])->name('comment.store');
        Route::get('/', [HomeController::class,'index'])->name('comment.index');
        Route::get('/delete/{id}', [HomeController::class, 'delete'])->name('comment.delete');

 });
 
