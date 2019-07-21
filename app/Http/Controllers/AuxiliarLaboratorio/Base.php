<?php
namespace App\Http\Controllers\AuxiliarLaboratorio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Base extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('SesionAutorizado:3'); //:3 Auxiliar Laboratorio
    }
}