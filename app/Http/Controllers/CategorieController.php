<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Categorie;
use Illuminate\Support\Str;

use App\Models\Post;

class CategorieController extends Controller
{
    public function index () {
        $categories = Categorie::all();
    
        return view('mycategories', [
            'title' => 'Mes categories',
            'categories' => $categories,
        ]);
    }

     public function create()
    {
        return view('createcategorie', [
            'categorie' => "All Categories"
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $folders = 'images/'.date("Y/m/d");
        $extension = $request->file('image')->extension();
        $imageName = time().'-'.Str::slug(basename($request->file('image')->getClientOriginalName(), ".".$extension), '-').'.'.$extension;
        $request->file('image')->move(public_path($folders), $imageName);
        $request->request->add(['image' => $folders.'/'.$imageName]);
    
        // Récupérer toutes les données du formulaire
        $postData = $request->only(['categorie', 'description']);
        $postData['image'] = $folders.'/'.$imageName;
        // Créer une nouvelle catégorie avec les données du formulaire
        Categorie::create($postData);
    
        return redirect()->route('admin.index.categories')
            ->with('success', 'Categorie created successfully.');
    }
    
    
    public function show($id)
    {
        $categorie = Categorie::find($id);
        return view('show', compact('categorie'));
    }

    public function edit($id)
    {
        $categorie = Categorie::find($id);
        return view('editcategories', [
            "categorie" => $categorie,
            
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'categorie' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $categorie = Categorie::find($id);
    
        if ($request->hasFile('image')) {
            $folders = 'images/'.date("Y/m/d");
            $extension = $request->file('image')->extension();
            $imageName = time().'-'.Str::slug(basename($request->file('image')->getClientOriginalName(), ".".$extension), '-').'.'.$extension;
            $request->file('image')->move(public_path($folders), $imageName);
            $categorie->image = $folders.'/'.$imageName;
        }
    
        $categorie->categorie = $request->categorie;
        $categorie->description = $request->description;
    
        $categorie->save();
    
        return redirect()->route('admin.index.categories')
            ->with('success', 'Categorie updated successfully.');
    }
    

    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();

        return redirect()->route('admin.index.categories')
            ->with('success', 'Categorie deleted successfully');
    }

}

