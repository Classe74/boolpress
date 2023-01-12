@extends('layouts.admin')

@section('content')

    <h1>{{$category->name}}</h1>
    <ul>
        @foreach ($category->posts as $post)
            <li>{{$post->title}}</li>
        @endforeach
    </ul>


@endsection
