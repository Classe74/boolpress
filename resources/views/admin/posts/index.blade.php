@extends('layouts.app')

@section('content')

    <ul>
        @foreach ($posts as $post)
            <li><a class="btn btn-primary text-white btn-sm" href="{{route('admin.posts.show', $post->slug)}}" title="View Post">{{$post->title}}</a></li>

        @endforeach
    </ul>

@endsection
