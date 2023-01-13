@extends('layouts.admin')

@section('content')
    <h1>Tags</h1>
    <form action="{{route('admin.tags.store')}}" method="post" class="d-flex align-items-center">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control" placeholder="
            Add a tag name here " aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Add</button>
        </div>
    </form>
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

                    </td>

                    <td>
                        {{$tag->posts && count($tag->posts) > 0 ? count($tag->posts) : 0}}
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

