@extends('layouts.master')

@section('head')
    <link href='/css/lesson.css' rel='stylesheet'>
@endsection

@section('title')
    View all Lessons
@endsection

@section('content')
    <h1> Lesson information for {{$user->first_name}} {{$user->last_name}} </h1>
    <h1>Lessons you are teaching</h1>

    @if(sizeof($teacher_lessons) == 0)
        You aren't teaching any lessons. You can <a href='/lessons/create'>add a lesson to teach</a>.
    @else
        <div id='lessons' class='cf'>
            @foreach($teacher_lessons as $lesson)

                <section class='lesson'>
                    <a href='/lessons/{{ $lesson->id }}'><h2 class='truncate'>{{ $lesson->id }}</h2></a>
                    {{ $lesson->duration }} minutes <br>
                    From {{ $lesson->start_time }} to {{ $lesson->end_time }}<br>
                    @if( sizeof($lesson->students)==1 )
                        with 1 student
                    @else
                        with {{sizeof($lesson->students)}} students
                    @endif
                    <br>

                    <a class='button' href='/lessons/{{ $lesson->id }}/edit'><i class='fa fa-pencil'></i> Edit</a>
                    <a class='button' href='/lessons/{{ $lesson->id }}'><i class='fa fa-eye'></i> View</a>
                    <a class='button' href='/lessons/{{ $lesson->id }}/delete'><i class='fa fa-trash'></i> Delete</a>
                </section>
            @endforeach
        </div>
    @endif

	<h1>Lessons you are attending as a student</h1>

    @if(sizeof($student_lessons) == 0)
        You don't have any lessons scheduled. If you are a student, please contact your teacher to schedule a lesson.  

    @else
        <div id='lessons' class='cf'>
            @foreach($student_lessons as $lesson)

                <section class='lesson'>
                    <a href='/lessons/{{ $lesson->id }}'><h2 class='truncate'>{{ $lesson->id }}</h2></a>


                    <a class='button' href='/lessons/{{ $lesson->id }}/edit'><i class='fa fa-pencil'></i> Edit</a>
                    <a class='button' href='/lessons/{{ $lesson->id }}'><i class='fa fa-eye'></i> View</a>
                    <a class='button' href='/lessons/{{ $lesson->id }}/delete'><i class='fa fa-trash'></i> Delete</a>
                </section>
            @endforeach
        </div>
    @endif

@endsection
