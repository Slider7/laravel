@extends ('layout')

@section ('content')

<h1 class='text-center'>Quiz:</h1>
<div class='d-flex justify-content-md-center mt-4'>
    <div class='mr-4'>
        <p>Название Quiz-а: </p>
        <p>Код Quiz-а: </p>
        <p>Программа: </p>
        <p>Unit: </p>
    </div>
    <div class='ml-4'>
        <p>{{$quiz->quiz_name}}</p>
        <p>{{$quiz->quiz_code}}</p>
        <p>{{$quiz->Program}}</p>
        <p>{{$quiz->Unit}}</p>
    </div>
</div>
@endsection