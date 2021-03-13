@extends('layouts.app')

@section('content')
    <div class="container">

        @include('questions._questions')
        @include('answers._index')
        @include('answers.create')
    </div>
@endsection
