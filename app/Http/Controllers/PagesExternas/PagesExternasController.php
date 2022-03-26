<?php

namespace App\Http\Controllers\PagesExternas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesExternasController extends Controller
{

    public function sobre()
    {
        return view('pagesExternas/sobre');
    }

    public function servicos()
    {
        return view('pagesExternas/servicos');
    }

    public function contatos()
    {
        return view('pagesExternas/contatos');
    }
}
