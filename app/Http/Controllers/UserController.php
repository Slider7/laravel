<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('user.index', [
      'users' => User::orderBy('name')->get()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    User::create($this->validateUser());
    return redirect('/users');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Quiz  $quiz
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
    //$quiz = Quiz::findOrFail($id);
    return view('user.show', ['user' => $user]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    return view('user.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    $user->name = request('name');
    $user->username = request('username');
    $user->email = request('email');
    $user->status = request('status');
    $user->role = request('role');
    $user->save();
    return redirect($user->path());
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
      $destroy = User::destroy($user->id);
      if ($destroy) {
        Session::flash('message','Пользователь ' . $user->username .' успешно удален.');
      } else {
        Session::flash('message','Quiz ' . $user->username .' не был удален. Есть зависимости/ошибка при удалении.');
      };
    return redirect('/users');
  }

}
