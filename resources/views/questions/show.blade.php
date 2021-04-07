@extends('layouts.app')

@section('content')
    <div class="container">

        @include('questions._questions')
        {{-- @include('answers._index') --}}
    {{-- <answers :answers="{{$question->answers}}" :count="{{$question->answers_count}}" ></answers>--}}
        <answers :question="{{$question}}"></answers>
       @include('answers.create')

 </div>
@endsection
