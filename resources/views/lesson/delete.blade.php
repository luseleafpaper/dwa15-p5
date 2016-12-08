@extends('layouts.master')

@section('title')
    Confirm Lesson Deletion
@endsection

@section('content')

    <h1>Confirm deletion</h1>
    <form method='POST' action='/lessons/{{ $lesson->id }}'>

        {{ method_field('DELETE') }}

        {{ csrf_field() }}

        <h2>Are you sure you want to delete the lesson starting at 
            <em>{{ $lesson->start_time }}</em>
            and ending at <em>{{ $lesson->end_time }}</em>?
        </h2>

        <input type='submit' value='Yes'>
        
    </form>

@endsection
