<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $posts = Post::paginate(3);
            //dd($posts);
        } else {
            $userId = Auth::id();
            $posts = Post::where('user_id', $userId)->paginate(3);
        }


        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StorePostRequest $request)
    {
        $userId = Auth::id();
        $data = $request->validated();
        $slug = Post::generateSlug($request->title);
        $data['slug'] = $slug;
        $data['user_id'] = $userId;
        if($request->hasFile('cover_image')){
            $path = Storage::put('post_images', $request->cover_image);
            $data['cover_image'] = $path;
        }

        $new_post = Post::create($data);

        if($request->has('tags')){
            $new_post->tags()->attach($request->tags);
        }
        return redirect()->route('admin.posts.show', $new_post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(Post $post)
    {
        if(!Auth::user()->isAdmin() && $post->user_id !== Auth::id()){
            abort(403);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(Post $post)
    {
        if(!Auth::user()->isAdmin() && $post->user_id !== Auth::id()){
            abort(403);
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if(!Auth::user()->isAdmin() && $post->user_id !== Auth::id()){
            abort(403);
        }

        $data = $request->validated();

        $slug = Post::generateSlug($request->title);
        $data['slug'] = $slug;

        if($request->hasFile('cover_image')){
            if ($post->cover_image) {
                Storage::delete($post->cover_image);
            }

            $path = Storage::put('post_images', $request->cover_image);
            $data['cover_image'] = $path;
        }
        $post->update($data);

        if($request->has('tags')){
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.index')->with('message', "$post->title updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     *
     */
    public function destroy(Post $post)
    {
        if(!Auth::user()->isAdmin() && $post->user_id !== Auth::id()){
            abort(403);
        }
        if($post->cover_image){
            Storage::delete($post->cover_image);
        }

        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', "$post->title deleted successfully");
    }
}
