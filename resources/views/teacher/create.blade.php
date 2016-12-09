@extends('layouts.master')

@section('title')
    Add a new book
@stop

@section('content')

    <h1>Add a new lesson</h1>

    <form method='POST' action='/lessons'>

        {{ csrf_field() }}


        <div class='form-group'>
           <label>Lesson Description </label>
            <input
                type='text'
                id='title'
                name='title'
                value='{{ old('title', '') }}'
            >
           <div class='error'>{{ $errors->first('title') }}</div>
        </div>
        
        <div class='form-group'>
           <label>Start Time 'YYYY/MM/DD HH:MM' </label>
            <input
                type='text'
                id='start_time'
                name='start_time'
                value='{{ old('start_time', '2017/01/10 10:10') }}'
            >
           <div class='error'>{{ $errors->first('start_time') }}</div>
        </div>

        <div class='form-group'>
           <label>End Time 'YYYY/MM/DD HH:MM'</label>
            <input
                type='text'
                id='end_time'
                name='end_time'
                value='{{ old('end_time', '2017/01/10 11:10') }}'
            >
           <div class='error'>{{ $errors->first('end_time') }}</div>
        </div>


         <div class='form-group'>
            <label>Students</label>        
                @foreach( $students_for_checkboxes as $student_id => $student_name ) 
                    <input type='checkbox' value='{{ $student_id }}'
                             name='students[]'> {{ $student_name }} <br>
                @endforeach 
        </div>

        <div class='form-group'>
            <label>Teachers</label>        
                @foreach( $teachers_for_checkboxes as $teacher) 
                    <input type='checkbox' value='{{ $teacher->id }}'
                         {{ ($teacher->user_id == $user->id) ? 'CHECKED' : '' }}
                         name='teachers[]'> {{ $teacher->user->first_name }}<br>
                @endforeach 
        </div>
            
        <button type="submit" class="btn btn-primary">Add Lesson</button>

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
