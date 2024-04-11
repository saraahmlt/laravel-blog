<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Post;

class CategorieController extends Controller
{
     public function create()
    {
        return view('createcategorie', [
            'categorie' => "All Categories"
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie'=>'required',
        ]);

        
    
        Post::create($postData);

        return redirect()->route('admin.mycategories')
            ->with('success', 'Categorie created successfully.');
    }

    public function show($id)
    {
        $post = Categorie::find($id);
        return view('show', compact('categorie'));
    }

    public function edit($id)
    {
        $categorie = Categorie::find($id);
        return view('editcategories', [
            "categorie" => "Edit Categorie ",
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
           'categorie'=>'required',
        ]);

        $categorie = Categorie::find($id);
        $categorie->update($request->all());

        return redirect()->route('admin.mycategories')
            ->with('success', 'Categorie updated successfully.');
    }

    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();

        return redirect()->route('admin.mycategories')
            ->with('success', 'Categorie deleted successfully');
    }

}

