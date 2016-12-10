@extends('layouts.master')

@section('title')
    Teacher Schedule
@endsection

@section('head')
    <link href='/css/book.css' rel='stylesheet'>
@endsection

@section('content')

    <h1 class='truncate'>Teaching schedule for {{$teacher_user->first_name}}</h1>
        @foreach($schedule as $item)
            {{ $item->start_time }}<br>
            {{ $item->end_time }}<br>
            {{ $item->status }}<br>
            <hr>
        @endforeach

@endsection
