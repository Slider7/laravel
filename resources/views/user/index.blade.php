@extends ('layout')

@section ('content')
<div class="container">
  <h3 class='text-center'>Список пользователей(сотрудников):</h3>
  <div class="d-flex flex-row justify-content-end">
    <a class="btn btn-outline-secondary mb-2 ml-4" href="/" role="button">&nbsp&nbsp&nbsp Выход &nbsp&nbsp&nbsp</a>
  </div>
  <table id="user-table" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style='display: none;'>quiz_id</th>
        <th>ФИО сотрудника</th>
        <th>Логин</th>
        <th>e-mail</th>
        <th>Статус</th>
        <th>Роль</th>
      </tr>
    </thead>
    @foreach($users as $user)
    <tr>
      <td style='display: none;'>{{$user['id']}}</td>
      <td><a href={{$user->path()}}>{{$user['name']}}</a></td>
      <td><a href={{$user->path()}}>{{$user['username']}}</a></td>
      <td>{{$user['email']}}</td>
      <td>{{$user['status'] ? 'Активно' : 'Блокирован'}}</td>
      <td>{{$user['role'] > 1 ? 'Администратор' : 'Пользователь'}}</td>
    </tr>
    @endforeach
  </table>
</div>
@endsection
