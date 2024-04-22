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
        return view('blog', ['posts' => $posts]);
    }
}

