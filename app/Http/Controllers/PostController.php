<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts' , compact('posts'));
        dd($posts);
//        $posts = Post::where('is_published', 1)->get();
//        $posts = Post::where('is_published', 1)->first();
//        foreach ($posts as $post){
//            dump($post->title);
//        }
//        dump($posts->title);

    }

    public function create()
    {
        $postsArr = [
            [
                'title' => 'title of post from phpstorm',
                'content' => 'some interesting content',
                'image' => 'image.jpg',
                'likes' => 20,
                'is_published' => 1,
            ],
            [
                'title' => 'another title of post from phpstorm',
                'content' => 'another some interesting content',
                'image' => 'another_image.jpg',
                'likes' => 50,
                'is_published' => 1,
            ],
        ];

        foreach ($postsArr as $item) {
            dump($item);
            Post::create($item);
        }
        dd('created');
    }

    public function update()
    {
        $post = Post::find(6);
        $post->update([
            'title' => 'updated',
            'content' => 'updated',
            'image' => 'updated',
            'likes' => 51,
            'is_published' => 1,
        ]);
        dd('updated');
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
        ],[
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
