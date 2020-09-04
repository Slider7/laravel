@extends('layout');

@section('content')
<div id='wrapper'>
    <div id='page' class='container col-md-8'>
        <h1>Редактирование пользователя</h1>

        <form method="POST" action="/users/{{$user->id}}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <fieldset>
                    <p class="lead">Введите данные пользователя: </p>
                    <label for="name" class="mt-2 mb-0">ФИО пользователя: </label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" required>
                    <label for="username" class="mt-2 mb-0">Логин:</label>
                    <input class="form-control" type="text" id="username" name="username" value="{{ $user->username }}" required>
                    <label for="email" class="mt-2 mb-0">e-mail:</label>
                    <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}" required>

                    <div class="row mt-2">
                      <div class="col">
                        <label class="w-100 text-right" for="status" class="mt-2 mb-0">Активен: </label>
                      </div>
                      <div class="col">
                        <input class="form-control w-25" type="checkbox" id="checkstatus" data-check = "{{ $user->status != 0 }}" onchange='statusChange()'>
                        <input type="hidden" id="status" name="status" value="{{ $user->status }}">
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <label class="w-100 text-right" for="role" class="mt-2 mb-0">Доступ администратора: </label>
                      </div>
                      <div class="col">
                        <input class="form-control w-25" type="checkbox" id="checkrole" data-check="{{ $user->role > 1  }}" onchange='roleChange()'>
                        <input type="hidden" id="role" name="role" value="{{ $user->role }}">
                      </div>
                    </div>

                </fieldset>
                <fieldset>
                    <input type="submit" class="btn btn-outline-primary mt-4" value='Сохранить' />
                    <a class="btn btn-outline-secondary ml-4 mt-4" href="/users" role="button">&nbsp&nbsp Отмена &nbsp&nbsp</a>
                </fieldset>
            </div>
        </form>

    </div>
</div>

<script>
    document.getElementById("checkstatus").checked = document.getElementById("checkstatus").dataset.check;
    document.getElementById("checkrole").checked = document.getElementById("checkrole").dataset.check;

    function statusChange() {
        const status = document.querySelector('#checkstatus').checked ? 1 : 0;
        document.querySelector('#status').value = status;
    };
    function roleChange() {
        const role = document.querySelector('#checkrole').checked ? 10 : 1;
        document.querySelector('#role').value = role;
    };
</script>

@endsection
