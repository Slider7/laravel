@extends('layout');

@section('content')
<div id='wrapper'>
    <div id='page' class='container'>
        <h1>Добавление Quiz-a</h1>

        <form method="POST" action="/quizzes" name='addquiz' class=''>
            @csrf
            <div class="form-group">
                <fieldset>
                    <p class="lead">Введите данные quiz-а: </p>
                    <label for="q-name" class="mt-2 mb-0">Наименование: </label>
                    <input class="form-control" type="text" id="q-name" name="quiz_name" placeholder="например, Family&Friends Unit1" required>
                    <label for="q-program" class="mt-2 mb-0">Программа:</label>
                    <input class="form-control" type="text" id="q-program" name="program" placeholder="например, GEa2" required onkeyup='progChange()'>
                    <label for="q-unit" class="mt-2 mb-0">Unit:</label>
                    <input class="form-control" type="number" id="q-unit" name="unit" min="0" max="20" value='0' required onchange='progChange()'>
                    <label for="q-code" class="mt-2 mb-0">Код quiz-a:</label>
                    <input class="form-control" type="text" id="q-code" name="quiz_code" readonly>
                    <input type="submit" class="btn btn-primary mt-4" value='Сохранить' />
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