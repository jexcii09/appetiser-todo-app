<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoArchiveController;

use App\Http\Controllers\PriorityLevelController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TagController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// User Authentication
Route::group(['prefix' => 'auth'], function(){
    Route::group(['prefix' => '/user', 'middleware' => 'auth:sanctum'], function(){
        Route::get('profile', [UserController::class, 'profile']);
        Route::get('logout', [UserController::class, 'logout']);
    });

    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
});

Route::group(['prefix' => '/todos', 'middleware' => 'auth:sanctum'], function(){
    Route::resource('/todo', TodoController::class);
    Route::put('/update-status/{id}', [TodoController::class, 'updateStatus']);

    Route::get('/archive', [TodoArchiveController::class, 'index']);
    Route::post('/archive/store', [TodoArchiveController::class, 'store']);
    Route::delete('/archive/delete/{id}', [TodoArchiveController::class, 'destroy']);
});

Route::resource('/images', ImageController::class);
Route::resource('/tags', TagController::class);

Route::group(['prefix' => '/options'], function(){
    Route::get('priority-levels', [PriorityLevelController::class, 'index']);
    Route::get('statuses', [StatusController::class, 'index']);
});