<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

//falta fazer essa parte
class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('posts.index', ['posts'=> $posts]);
    }

    public function create(){
        return view('posts.create');
    }


    public function store(Request $request){
        $request -> validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $post = new Post;
        
        $file_name = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $file_name;

        $post->save();
        return redirect()->route('posts.index') ->with('success', 'Post created successfully.');

    }


    public function show(Post $post){
        return view('posts.show', ['post' => $post]);
    }

    public function destroy($id){
        $post = Post::findOrFail($id); // Busca o post pelo ID

        $post->delete(); // Apenas remove do banco

        return redirect()->route('posts.index')->with('success', 'Post removido do banco com sucesso.');
    }

}
