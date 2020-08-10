@extends ('layout')

@section ('content')
<div class="container col-md-8">
    <h1 class='text-center mt-4'>Quiz:</h1>
    <div class='d-flex justify-content-around m-2 p-2 lead border border-info rounded-lg'>
        <div>
            <p>Название Quiz-а: </p>
            <p>Код Quiz-а: </p>
            <p>Программа: </p>
            <p>Unit: </p>
        </div>
        <div>
            <p>{{$quiz->quiz_name}}</p>
            <p>{{$quiz->quiz_code}}</p>
            <p>{{$quiz->Program}}</p>
            <p>{{$quiz->Unit}}</p>
        </div>
    </div>
    <a class="btn btn-outline-primary m-2" href="{{ $quiz->path() }}/edit" role="button">Редактировать</a>
    <a class="btn btn-outline-secondary ml-4" href="/quizzes" role="button">&nbsp&nbsp Закрыть &nbsp&nbsp</a>
</div>
@endsection