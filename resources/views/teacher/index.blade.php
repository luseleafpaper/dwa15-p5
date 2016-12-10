@extends('layouts.master')

@section('head')
    <link href='/css/lesson.css' rel='stylesheet'>
@endsection

@section('title')
    View all Lessons
@endsection

@section('content')
    <h1> Teacher information </h1>

    @if(sizeof($teachers) == 0)
        You have no teachers assigned to you. Please contact your teacher and ask him or her to add you as their student. 
    @else
        @foreach($teachers as $teacher)
            <a href='/teachers/{{$teacher->id}}'>{{$teacher->user->first_name}}</a>
            <br>
        @endforeach
    @endif

@endsection
