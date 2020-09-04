@extends('layouts.app')

@if (Gate::allows('active-user'))
  @section('content')
  <div id="root"></div>
  @endsection
@else
  @section('content')
    <h3 class='text-center'>Обратитесь к администратору для активации Вашего доступа!</h3>
  @endsection
@endif
