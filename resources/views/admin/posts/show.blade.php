@extends('layouts.admin')

@section('content')

    <h1>{{$post->title}}</h1>
    @if ($post->category)
    <small>Category: {{$post->category->name}}</small>
    @endif

    <p>{!! $post->content !!}</p>
    <img width="300" src="{{ asset('storage/' . $post->cover_image) }}">

@endsection
