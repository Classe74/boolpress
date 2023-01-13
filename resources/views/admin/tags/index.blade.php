@extends('layouts.admin')

@section('content')
    <h1>Tags</h1>
    <div class="text-end">
        <a class="btn btn-success" href="">Crea nuovo Tag</a>
    </div>

    @if(session()->has('message'))
    <div class="alert alert-success mb-3 mt-3">
        {{ session()->get('message') }}
    </div>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Posts</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
                <tr>
                    <th scope="row">{{$tag->id}}</th>
                    <td>
                        <form id="tag-{{$tag->id}}" action="{{route('admin.tags.update', $tag->slug)}}" method="post">
                            @csrf
                            @method('PATCH')
                            <input class="border-0 bg-transparent" type="text" name="name" value="{{$tag->name}}">
                        </form>
                        {{-- <a href="{{route('admin.categories.show', $tag->slug)}}" title="View Ctegory">{{$tag->name}}</a> --}}
                    </td>

                    {{-- <td>{{count($tag->posts) > 0 ? count($tag->posts)  : 0}}</td> --}}
                    <td>

                    </td>
                    <td>
                        <form action="{{route('admin.tags.destroy', $tag->slug)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button btn btn-danger ms-3" data-item-title="{{$tag->name}}"><i class="fa-solid fa-trash-can"></i></button>
                     </form>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>
    @include('partials.admin.modal-delete')
@endsection

