<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //

    public function index() {
        $posts =  Post::all();
        return new PostCollection($posts);
    }

    public function store(Request $request) {
        Post::create([
            'title' => $request->title,
            'news_content' => $request->news_content,
            'author' => $request->author
        ]);
    }

    public function update(Request $request, $id) {
        $update = Post::findOrFail($id)->first();
        $update['title'] = $request->title;
        $update['news_content'] = $request->news_content;

        $update->save();
    }

    public function show($id) {
        $posts = Post::where('id', $id)->get();
        return new PostCollection($posts);
    }
    public function delete($id) {
        Post::findOrFail($id)->delete();
    }
}