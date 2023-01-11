@extends('layouts.admin')

@section('content')

    <h1>{{$post->title}}</h1>
    <p>{{$post->content}}</p>
    <img width="300" src="{{ asset('storage/' . $post->cover_image) }}">

@endsection
