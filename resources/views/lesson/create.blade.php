@extends('layouts.master')

@section('title')
    Add a new book
@stop

@section('content')

    <h1>Add a new lesson</h1>

    <form method='POST' action='/books'>

        {{ csrf_field() }}
        
        @foreach( $students_for_dropdown as $student_name ) 
            {{ $student_name }} 
            <br>
        @endforeach 

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
