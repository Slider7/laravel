@extends ('layout')

@section ('content')
<div>
    <h1 class='text-center'>Перечень тестов(quiz):</h1>

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
        @foreach($quizzes as $row)
        <tr>
            <td style='display: none;'>{{$row['quiz_id']}}</td>
            <td>{{$row['quiz_name']}}</td>
            <td>{{$row['quiz_code']}}</td>
            <td>{{$row['Program']}}</td>
            <td>{{$row['Unit']}}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection