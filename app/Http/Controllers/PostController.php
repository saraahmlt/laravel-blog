<?php

namespace App\Http\Controllers;



use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::all();
        $categories = Categorie::all();

        return view('blog', [
            'title' => 'My posts',
            'content' => '<h1>My posts</h1><p>Lorem Ipsum ...</p>',
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }

    public function categorie(Categorie $categorie) : View
    {
        $categories = Categorie::all();
        $posts = $categorie->posts;
        return view('blogcategories', [
            'image' => $categorie->image,
            'title' => $categorie->categorie,
            'content' => $categorie->description,
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }

    public function show(Post $post) : View
    {
        return view('postsingle', [
            'title' => $post->title,
            'post' => $post,
        ]);
    }

}

