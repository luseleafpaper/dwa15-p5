@extends('layouts.master')

@section('title')
    Lesson {{ $lesson->id}}  
@endsection

@section('head')
    <link href='/css/book.css' rel='stylesheet'>
@endsection

@section('content')

    <h1 class='truncate'>{{$lesson->title}}</h1>
    {{$lesson->duration}} minutes <br>
    Start time: {{$lesson->start_time}}<br>
    End time: {{$lesson->end_time}}
    <h2 class='truncate'>Teachers</h2>
        @foreach($teachers as $teacher)
            {{ $teacher }}<br>
        @endforeach
    <h2 class='truncate'>Students</h2>
        @foreach($students as $student)
            {{ $student }} <br> 
        @endforeach

@endsection
