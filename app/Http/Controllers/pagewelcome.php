<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Post;



class pagewelcome extends Controller
{
    public function welcome(): View
    {
        $posts = Post::all();
        return view('welcome', ['posts' => $posts]);
    }
}
