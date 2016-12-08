@extends('layouts.master')

@section('title')
    Add a new book
@stop

@section('content')

    <h1>Add a new lesson</h1>

    <form method='POST' action='/lessons'>

        {{ csrf_field() }}
        
        <div class='form-group'>
           <label>Start Time</label>
            <input
                type='text'
                id='start_time'
                name='start_time'
                value='{{ old('start_time', 'YYYY/MM/DD HH:MM') }}'
            >
           <div class='error'>{{ $errors->first('start_time') }}</div>
        </div>

        <div class='form-group'>
           <label>End Time</label>
            <input
                type='text'
                id='end_time'
                name='end_time'
                value='{{ old('start_tme', 'YYYY/MM/DD HH:MM') }}'
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

        <button type="submit" class="btn btn-primary">Add book</button>

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
