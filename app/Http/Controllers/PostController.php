<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->with('user','likes')->paginate(20);
        return view('posts.index',['posts'=> $posts]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'body' => 'required'
        ]);
        $request->user()->posts()->create($request->only('body'));
        return back();
    }

    public function destroy(Post $post){
        if(!$post->ownedBy(auth()->user())){
            dd('not authorized');
        }
        $post->delete();
        return back();
    }
}