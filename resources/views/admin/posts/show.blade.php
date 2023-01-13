@extends('layouts.admin')

@section('content')

    <h1>{{$post->title}}</h1>
    @if ($post->category)
    <small>Category: {{$post->category->name}}</small>
    @endif

    <p>{!! $post->content !!}</p>
    <img width="300" src="{{ asset('storage/' . $post->cover_image) }}">
    @if($post->tags && count($post->tags) > 0)
       @foreach ($post->tags as $tag)
        <span>{{$tag->name}}</span>

       @endforeach
    @endif

@endsection
