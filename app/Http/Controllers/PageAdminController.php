<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Post; 



    class PageAdminController extends Controller
    {
    
        public function dashboard(): View
        {
            return view('dashboard', [
                'title' => 'Dashboard',
                'content' => '<h1>Dashboard</h1><p>Lorem Ipsum 2 ...</p>',
            ]);
        }
    
        public function myposts(): View
        {
    //      
            $posts = Post::latest()->get();
    
            return view('myposts', [
                'title' => 'My posts',
                'content' => '<h1>My posts</h1><p>Lorem Ipsum ...</p>',
                'posts' => $posts,
            ]);
        }
}
