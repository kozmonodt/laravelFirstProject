<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $category = Category::find(1);

//        $posts = Post::where('category_id', $category->id)->get();
        $post = Post::find(1);
        dd($category->posts);
//        dd($post->category);
//        return view('post.index' , compact('posts'));


    }

    public function create()
    {
        return view('post.create');

    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);
        Post::create($data);
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);
        $post->update($data);
        return redirect()->route('posts.show', $post->id);

    }


    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function delete()
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('restored');
    }

    public function firstOrCreate()
    {
//        $post = Post::find(1);
        $anotherPost = [
            'title' => 'some post shit',
            'content' => 'another some interesting content',
            'image' => 'another_image.jpg',
            'likes' => 49,
            'is_published' => 1,
        ];
        $post = Post::firstOrCreate([
            'title' => 'shit'
        ], [
            'title' => 'some post shit',
            'content' => 'another some interesting content',
            'image' => 'another_image.jpg',
            'likes' => 49,
            'is_published' => 1,
        ]);
        dump($post->title);
        dd('finished');
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => '2ORC post shit',
            'content' => 'another some interesting content',
            'image' => 'another_image.jpg',
            'likes' => 49,
            'is_published' => 1,
        ];
        $post = Post::updateOrCreate([
            'title' => 'ORC post shit'
        ], [
            'title' => 'new ORC post shit',
            'content' => 'another some interesting content',
            'image' => 'another_image.jpg',
        ]);
        dump($post->title);
        dd(777);
    }
}
