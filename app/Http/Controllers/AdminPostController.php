<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Post; 

        
        class AdminPostController extends Controller
        {
        
            public function create()
            {
                return view('createpost', [
                    'title' => "All Posts"
                ]);
            }
            public function store(Request $request)
            {
                $request->validate([
                    'title' => 'required|max:255',
                    'description' => 'required',
                    'content' => 'required',
                    'image' => 'required'
                ]);
                Post::create($request->all());
                return redirect()->route('admin.myposts')
                    ->with('success', 'Post created successfully.');
            }
        
            public function show($id)
            {
                $post = Post::find($id);
                return view('admin.posts.show', compact('post'));
            }
        
            public function edit($id)
            {
                $post = Post::find($id);
                return view('editposts', [
                    "title" => "Edit Post",
                    "post" => $post
                ]);
            }
            public function update(Request $request, $id)
            {
                $request->validate([
                    'title' => 'required|max:255',
                    'description' => 'required',
                    'content' => 'required',
                    'image' => 'required'
                ]);
                $post = Post::find($id);
                $post->update($request->all());
                return redirect()->route('admin.myposts')
                    ->with('success', 'Post updated successfully.');
            }
        
            public function destroy($id)
            {
                $post = Post::find($id);
                $post->delete();
                return redirect()->route('admin.myposts')
                    ->with('success', 'Post deleted successfully');
            }
        
        }    
    


