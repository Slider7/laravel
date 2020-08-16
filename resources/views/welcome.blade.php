@extends ('layout')

@section ('content')

<div class="d-flex justify-content-center position-ref full-height">
  @if (Route::has('login'))
  <div class="top-right links">
    @auth
    <a href="{{ url('/home') }}">Home</a>
    @else
    <a href="{{ route('login') }}">Login</a>

    @if (Route::has('register'))
    <a href="{{ route('register') }}">Register</a>
    @endif
    @endauth
  </div>
  @endif

  <div class="d-flex align-items-center">
    <h2>Войдите в систему для работы с отчетами</h2>
  </div>

  @endsection