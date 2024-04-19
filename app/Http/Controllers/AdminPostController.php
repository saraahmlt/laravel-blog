<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

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
        $folders = 'images/'.date("Y/m/d");
        $extension = $request->file('image')->extension();
        $imageName = time().'-'.Str::slug(basename($request->file('image')->getClientOriginalName(), ".".$extension), '-').'.'.$extension;
        $request->file('image')->move(public_path($folders), $imageName);
        $request->request->add(['image' => $folders.'/'.$imageName]);

        // Associer l'user_id du post à l'utilisateur connecté
        $postData = $request->all();
        $postData['image'] = $folders.'/'.$imageName;
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
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $post = Post::find($id);

    
    if ($request->hasFile('image')) {
        $folders = 'images/'.date("Y/m/d");
        $extension = $request->file('image')->extension();
        $imageName = time().'-'.Str::slug(basename($request->file('image')->getClientOriginalName(), ".".$extension), '-').'.'.$extension;
        $request->file('image')->move(public_path($folders), $imageName);
        $post->image = $folders.'/'.$imageName;
    }

    
    $post->title = $request->title;
    $post->description = $request->description;
    $post->content = $request->content;

    
    $post->save();

   
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

