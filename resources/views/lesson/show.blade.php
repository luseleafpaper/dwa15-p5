@extends('layouts.master')

@section('title')
    Lesson {{ $lesson->id}}  
@endsection

@section('head')
    <link href='/css/book.css' rel='stylesheet'>
@endsection

@section('content')

    <h1 class='truncate'>Lesson Details</h1>

    <h2 class='truncate'>Lesson ID</h2>
    <h2 class='truncate'>Start time</h2>
    <h2 class='truncate'>End time</h2>
    <h2 class='truncate'>Taught by</h2>
        @foreach($teachers as $teacher)
            {{ $teacher }}<br>
        @endforeach
    <h2 class='truncate'>Attended by</h2>
        @foreach($students as $student)
            {{ $student }} <br> 
        @endforeach

@endsection
