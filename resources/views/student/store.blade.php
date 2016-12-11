@extends('layouts.master')


@section('title')
    Success!
@stop


@section('content')
    Success! The lesson {{ $title }} was added.

    <a href='/lessons/create'>Add another one...</a>
@stop
