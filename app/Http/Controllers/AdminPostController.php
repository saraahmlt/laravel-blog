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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        
    
        // Traitement de l'image
       
    

        // Associer l'user_id du post à l'utilisateur connecté
        $postData = $request->all();
        $postData['user_id'] = Auth::id(); // Associating the post with the currently authenticated user
        
        
        Post::create($postData);

        return redirect()->route('admin.myposts')
            ->with('success', 'Post created successfully.');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('show', compact('post'));
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
?>

