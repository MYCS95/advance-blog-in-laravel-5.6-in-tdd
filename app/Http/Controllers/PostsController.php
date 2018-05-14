<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }
    
    /**
     * Retrieve all blog post
     *
     */

    public function index(Post $post)
    { // We inject post model

        // Retrieve all posts sort by created_at desc
        $posts = $post::latest()->get();

        // Bind query result to view
        return view('post.index')->with(['posts'=>$posts]);
    }

    public function show(Post $post)
    {
        return view('post.show')->with(['post' => $post]);
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect('/blog/'.$post->id);
    }
}
