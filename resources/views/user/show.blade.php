@extends ('layout')

@section ('content')
<div class="container col-md-8">
    <h1 class='text-center mt-4'>Пользователь(сотрудник):</h1>
    <div class='d-flex justify-content-around m-2 p-2 lead border border-info rounded-lg'>
        <div>
            <p>ФИО сотрудника: </p>
            <p>Логин: </p>
            <p>e-mail: </p>
            <p>Статус: </p>
            <p>Роль: </p>
        </div>
        <div>
            <p>{{$user->name}}</p>
            <p>{{$user->username}}</p>
            <p>{{$user->email}}</p>
            <p>{{$user['status'] ? 'Активно' : 'Блокирован'}}</p>
            <p>{{$user['role'] > 1 ? 'Администратор' : 'Пользователь'}}</p>
        </div>
    </div>
    <a class="btn btn-outline-primary m-2" href="{{ $user->path() }}/edit" role="button">Редактировать</a>
    <form action="{{ $user->path() }}" method="POST" class='d-inline'>
        @method('DELETE')
        @csrf
      <button type="submit" class="btn btn-large btn-danger my-2 mr-4">Удалить</button>
    </form>
    <a class="btn btn-outline-secondary ml-4" href="/users" role="button">&nbsp&nbsp Закрыть &nbsp&nbsp</a>
</div>
@endsection
