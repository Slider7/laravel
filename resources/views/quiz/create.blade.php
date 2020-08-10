@extends('layout');

@section('content')
<div id='wrapper'>
    <div id='page' class='container col-md-8'>
        <h1>Добавление Quiz-a</h1>

        <form method="POST" action="/quizzes" name='addquiz' class=''>
            @csrf
            <div class="form-group">
                <fieldset>
                    <p class="lead">Введите данные quiz-а: </p>
                    <label for="q-name" class="mt-2 mb-0">Наименование: </label>
                    <input class="form-control @error('quiz_name') border-danger @enderror" type="text" id="q-name" name="quiz_name" placeholder="например, Family&Friends Unit1" value="{{old('quiz_name')}}">
                    @error('quiz_name') <p class="help font-weight-bold text-danger">{{ $errors->first('quiz_code')}}</p> @enderror

                    <label for="q-program" class="mt-2 mb-0">Программа:</label>
                    <input class="form-control @error('program') border-danger @enderror" type="text" id="q-program" name="program" placeholder="например, GEa2" onkeyup='progChange()' value="{{old('program')}}">
                    @error('program') <p class="help font-weight-bold text-danger">{{ $errors->first('program')}}</p> @enderror

                    <label for="q-unit" class="mt-2 mb-0">Unit:</label>
                    <input class="form-control @error('unit') border-danger @enderror" type="number" id="q-unit" name="unit" min="1" max="20" onchange='progChange()' value="{{old('unit')}}">
                    @error('unit') <p class="help font-weight-bold text-danger">{{ $errors->first('unit')}}</p> @enderror

                    <label for="q-code" class="mt-2 mb-0">Код quiz-a:</label>
                    <input class="form-control" type="text" id="q-code" name="quiz_code" readonly value="{{old('quiz_code')}}">
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