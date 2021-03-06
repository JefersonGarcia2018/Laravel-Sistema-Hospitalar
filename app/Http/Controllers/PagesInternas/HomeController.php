<?php

namespace App\Http\Controllers\PagesInternas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function home()
    {


        return view('pagesInternas/home', [
            'user' => Auth::user()
        ]);
    }

    
}
