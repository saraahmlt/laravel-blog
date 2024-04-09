<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;



class PageControl extends Controller
{
    public function legals(): View
    {
        $items = array (
            "test",
            "test2",
        );
        return view('legals', [
            'title' => 'Legals',
            'content' => 'Lorem ipsum..',
            'items' =>$items
        ]);
    }
}


