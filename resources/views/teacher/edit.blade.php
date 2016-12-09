@extends('layouts.master')

@section('title')
    Add a new book
@stop

@section('content')

    <h1>Edit {{ $lesson->id }} </h1>

    <form method='POST' action='/lessons/{{ $lesson->id }}'>

        {{ method_field('PUT') }}


        {{ csrf_field() }}

        
        <div class='form-group'>
           <label>Lesson Description</label>
            <input
                type='text'
                id='title'
                name='titile'
                value='{{ old('title', $lesson->title) }}'
            >
           <div class='error'>{{ $errors->first('title') }}</div>
        </div>

        
        <div class='form-group'>
           <label>Start Time</label>
            <input
                type='text'
                id='start_time'
                name='start_time'
                value='{{ old('start_time', $lesson->start_time) }}'
            >
           <div class='error'>{{ $errors->first('start_time') }}</div>
        </div>

        <div class='form-group'>
           <label>End Time</label>
            <input
                type='text'
                id='end_time'
                name='end_time'
                value='{{ old('start_time', $lesson->end_time) }}'
            >
           <div class='error'>{{ $errors->first('end_time') }}</div>
        </div>


         <div class='form-group'>
            <label>Students</label>
            @foreach($students_for_checkboxes as $student_id => $student_name)
                <input
                type='checkbox'
                value='{{ $student_id }}'
                name='students[]'
                {{ (in_array($student_name, $students_for_this_lesson)) ? 'CHECKED' : '' }}
                >
                {{ $student_name }} <br>
            @endforeach
            <div class='error'>{{ $errors->first('students') }}</div>
        </div>



        <div class='form-group'>
            <label>Teachers</label>
                @foreach( $teachers_for_checkboxes as $teacher)
                    <input type='checkbox' value='{{ $teacher->id }}'
                         {{ (in_array($teacher->id, $teachers_for_this_lesson)) ? 'CHECKED' : '' }}
                         name='teachers[]'
                    > 
                    {{ $teacher->user->first_name }} <br>
                @endforeach 
            <div class='error'>{{ $errors->first('teachers') }}</div>
        </div>



        <button type="submit" class="btn btn-primary">Update Lesson</button>

        {{--
        <ul class=''>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        --}}

        <div class='error'>
            @if(count($errors) > 0)
                Please correct the errors above and try again.
            @endif
        </div>

    </form>


@stop
