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
  //return view('welcome');
  return redirect('/home');
});

// REST Quiz
Route::get('/quizzes', 'QuizController@index');
Route::post('/quizzes', 'QuizController@store');
Route::get('/quizzes/create', 'QuizController@create')->name('quizzes.create');
Route::get('/quizzes/{quiz}', 'QuizController@show')->name('quizzes.show');
Route::get('/quizzes/{quiz}/edit', 'QuizController@edit');
Route::put('/quizzes/{quiz}', 'QuizController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// REST quiz_results
Route::get('/quizresults', 'QuizResultController@index');
Route::get('/quizresults/{quiz_result}', 'QuizResultController@show');

// REST GET filter columns
Route::get('/program-col', 'QuizController@programs');
Route::get('/unit-col', 'QuizController@units');
Route::get('/teacher-col', 'QuizResultController@teachers');
Route::get('/gruppa-col', 'QuizResultController@groups');
Route::get('/period-col', 'QuizController@periods');

// REST GET Report
Route::get('/report', 'ReportController@index');
Route::get('/report/{teacher}/{program}/{unit}/{gruppa}/{period}', 'ReportController@GroupedReport');
Route::get('/gruppa-report/{teacher}/{program}/{unit}/{gruppa}', 'ReportController@GruppaDetailReport');
Route::get('/extra-report/{teacher}/{program}/{unit}/{gruppa}/{period}', 'ReportController@filterReport');
