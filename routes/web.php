<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// REST Quiz

Route::get('/quizzes', 'QuizController@index');

Route::post('/quizzes', 'QuizController@store');

Route::get('/quizzes/create', 'QuizController@create');

Route::get('/quizzes/{quiz}', 'QuizController@show');
