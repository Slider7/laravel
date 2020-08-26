@extends ('layout')

@section ('content')
<div class="container">
  <h3 class='text-center'>Список тестов(quiz-ов):</h3>
  <div class="d-flex flex-row justify-content-end">
    <a class="btn btn-outline-primary mb-2" href="{{ route('quizmanage.create') }}" role="button">Новый Quiz</a>
    <a class="btn btn-outline-secondary mb-2 ml-4" href="/" role="button">&nbsp&nbsp&nbsp Выход &nbsp&nbsp&nbsp</a>
  </div>
  <table id="quiz-table" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style='display: none;'>quiz_id</th>
        <th>Название Quiz-а</th>
        <th>Код Quiz-а</th>
        <th>Программа</th>
        <th>Unit</th>
      </tr>
    </thead>
    @foreach($quizzes as $quiz)
    <tr>
      <td style='display: none;'>{{$quiz['quiz_id']}}</td>
      <td><a href="{{ $quiz->path() }}">{{$quiz['quiz_name']}}</a></td>
      <td>{{$quiz['quiz_code']}}</td>
      <td>{{$quiz['Program']}}</td>
      <td>{{$quiz['Unit']}}</td>
    </tr>
    @endforeach
  </table>
</div>
@endsection
