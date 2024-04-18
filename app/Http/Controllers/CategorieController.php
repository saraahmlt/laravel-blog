<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Categorie;

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
            'image' => 'required',
        ]);
    
        // Récupérer toutes les données du formulaire
        $data = $request->only(['categorie', 'description', 'image']);
    
        // Créer une nouvelle catégorie avec les données du formulaire
        Categorie::create($data);
    
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
           'categorie'=>'required',
           'description' => 'required',
           'image' => 'required',
        ]);

        $categorie = Categorie::find($id);
        $categorie->update($request->all());

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

