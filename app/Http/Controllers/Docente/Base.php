<?php
namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Base extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('SesionAutorizado:2'); //:2 Docente
    }
}