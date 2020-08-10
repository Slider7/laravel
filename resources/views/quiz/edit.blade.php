@extends('layout');

@section('content')
<div id='wrapper'>
    <div id='page' class='container col-md-8'>
        <h1>Редактирование Quiz-a</h1>

        <form method="POST" action="/quizzes/{{$quiz->quiz_id}}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <fieldset>
                    <p class="lead">Введите данные quiz-а: </p>
                    <label for="q-name" class="mt-2 mb-0">Наименование: </label>
                    <input class="form-control" type="text" id="q-name" name="quiz_name" value="{{ $quiz->quiz_name }}" required>
                    <label for="q-program" class="mt-2 mb-0">Программа:</label>
                    <input class="form-control" type="text" id="q-program" name="program" value="{{ $quiz->Program }}" required onkeyup='progChange()'>
                    <label for="q-unit" class="mt-2 mb-0">Unit:</label>
                    <input class="form-control" type="number" id="q-unit" name="unit" min="0" max="20" value="{{ $quiz->Unit }}" required onchange='progChange()'>
                    <label for="q-code" class="mt-2 mb-0">Код quiz-a:</label>
                    <input class="form-control" type="text" id="q-code" name="quiz_code" value="{{ $quiz->quiz_code }}" readonly>
                </fieldset>
                <fieldset>
                    <input type="submit" class="btn btn-outline-primary mt-4" value='Сохранить' />
                    <a class="btn btn-outline-secondary ml-4 mt-4" href="/quizzes" role="button">&nbsp&nbsp Отмена &nbsp&nbsp</a>
                </fieldset>
            </div>
        </form>

    </div>
</div>

<script>
    function progChange() {
        document.querySelector('#q-code').value = `${document.querySelector('#q-program').value}_${document.querySelector('#q-unit').value}`;
    };
</script>


@endsection