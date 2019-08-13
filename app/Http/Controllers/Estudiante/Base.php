<?php
namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Base extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('SesionAutorizado:5'); //:5 Estudiante
    }
}