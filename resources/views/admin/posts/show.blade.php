@extends('layouts.admin')

@section('content')

    <h1>{{$post->title}}</h1>
    <p>{{$post->content}}</p>

@endsection
