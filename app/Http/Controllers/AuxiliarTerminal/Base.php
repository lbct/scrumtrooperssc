<?php
namespace App\Http\Controllers\AuxiliarTerminal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Base extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('SesionAutorizado:4'); //:4 Auxiliar Terminal
    }
}