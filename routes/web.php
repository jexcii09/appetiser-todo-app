<?php

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
    return redirect('/todo');
});

Route::get('/login', function () {
    return view('login');
});


Route::get('/register', function () {
    return view('register');
});




Route::group(['prefix'=>'/todo'], function(){
    Route::get('/', function () { return view('todo'); });
    Route::get('/create', function () { return view('todo-form'); });
    Route::get('/edit/{id}', function(){ return view('todo-form'); });
    
    Route::get('/archives', function(){ return view('todo-archive'); });
});


