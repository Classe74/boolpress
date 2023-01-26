<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
{
    $posts = Post::with('category','tags')->paginate(3);
    return response()->json([
        'success' => true,
        'results' => $posts
    ]);
}

public function show($slug){
        $post = Post::where('slug', $slug)->with('category', 'tags')->first();
        if($post){
            return response()->json([
                'success' => true,
                'results' => $post
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => 'Nessun post trovato'
            ]);
        }
}
}
