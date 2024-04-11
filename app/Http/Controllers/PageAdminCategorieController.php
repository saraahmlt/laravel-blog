<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Post;



class PageAdminCategorieController extends Controller
{
    public function dashboard(): View
        {
            return view('dashboard', [
                'title' => 'Dashboard',
                'content' => '<h1>Dashboard</h1><p>Lorem Ipsum 2 ...</p>',
            ]);
        }
    
        public function mycategories(): View
        {
    //      
            $categorie = Categorie::latest()->take(6)->get();
    
            return view('mycategories', [
                'title' => 'Mes categories',
                'categorie' => $categorie,
            ]);
}
}
