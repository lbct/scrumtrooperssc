<?php
namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Base extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('SesionAutorizado:1'); //:1 Administrador
    }
}