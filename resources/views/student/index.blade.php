@extends('layouts.master')

@section('head')
    <link href='/css/lesson.css' rel='stylesheet'>
@endsection

@section('title')
    View all Lessons
@endsection

@section('content')
    <h1> Student information </h1>

    @if(sizeof($students) == 0)
        You have no students assigned to you. Please contact your student and ask him or her to add you as their student. 
    @else
        @foreach($students as $student)
            {{--
            <a href='/students/{{$student->id}}'>{{$student->user->first_name}}</a> {{$student->status}}
            --}}
            {{$student->user->first_name}} {{$student->status}}
            <br>
        @endforeach
    @endif

@endsection
