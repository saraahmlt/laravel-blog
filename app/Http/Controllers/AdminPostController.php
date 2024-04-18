<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Post;
use App\Models\Categorie;


class AdminPostController extends Controller
{

    public function create()
    {
        $categories = Categorie::all();

        return view('createpost', [
            'title' => "All Posts",
            'categories' => $categories
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
        
        $post = Post::create($postData);

        $post->categories()->attach($request->categories);

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
        $categories = Categorie::all();
        $post = Post::find($id);
        $idCategories = array_column($post->categories->all(), 'id');
        return view('editposts', [
            "title" => "Edit Post",
            "post" => $post,
            'categories' => $categories,
            'idCategories' => $idCategories,
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

        $post->categories()->sync($request->categories);

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

