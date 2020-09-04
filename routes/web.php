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
Route::group(['prefix' => 'quizmanage',  'middleware' =>  ['auth', 'can:admin-quizzes']], function()
{
  Route::get('/', 'QuizController@index');
  Route::post('/', 'QuizController@store');
  Route::get('/create', 'QuizController@create')->name('quizmanage.create');
  Route::delete('/{quiz}', 'QuizController@destroy');
  Route::get('/{quiz}', 'QuizController@show')->name('quizmanage.show');
  Route::get('/{quiz}/edit', 'QuizController@edit');
  Route::put('/{quiz}', 'QuizController@update');
});

// REST User
Route::group(['prefix' => 'users',  'middleware' =>  ['auth', 'can:admin-users']], function()
{
  Route::get('/', 'UserController@index');
  Route::post('/', 'UserController@store');
  //Route::get('/create', 'UserController@create')->name('quizmanage.create');
  Route::delete('/{user}', 'UserController@destroy');
  Route::get('/{user}', 'UserController@show')->name('users.show');
  Route::get('/{user}/edit', 'UserController@edit');
  Route::put('/{user}', 'UserController@update');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// REST quiz_results
Route::group(['prefix' => 'qr',  'middleware' =>  ['auth', 'can:admin-results']], function(){
  Route::get('/', 'QuizResultController@index');
  Route::post('/{quiz_result}', 'QuizResultController@destroy');
  Route::get('/{quiz_result}', 'QuizResultController@show');
});

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

// REST GET Answers
Route::get('/answers', 'AnswerController@index');
Route::get('/answers/{quiz_result}', 'AnswerController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
