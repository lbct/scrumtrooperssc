<?php
namespace App\Http\Controllers\Docente\Clases\Ver;

use App\Models\Usuario;
use App\Models\Sesion;
use App\Models\Materia;
use App\Models\GrupoDocente;
use App\Models\GrupoADocente;
<<<<<<< HEAD
=======
use App\Models\GuiaPractica;
>>>>>>> origin
use App\Models\Auxiliar;
use App\Models\Docente;
use App\Models\Gestion;
use App\Classes\Rol;
use App\Models\Clase;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Response;

class Control extends Base
{
    //Obtiene la vista principal del Docente
    public function getClasesUltimaGestion(Request $request)
    {
        if( $this->rol->is($request)){
            $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
            return $this->getClases($request, $id_gestion);
        }
        return redirect('login');
    }

    public function getClases(Request $request, $id_gestion){
        if( $this->rol->is($request) ){
            $usuarioId = $request->cookie('USUARIO_ID');
            $docenteId = Docente::where('USUARIO_ID', '=', $usuarioId)->get()->first()->ID;
            $gestiones = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->get();
            
<<<<<<< HEAD
            $ultimaSemana = Sesion::join('CLASE', 'CLASE.ID', '=', 'SESION.CLASE_ID')
            ->join('GRUPO_A_DOCENTE', 'GRUPO_A_DOCENTE.ID', '=', 'CLASE.GRUPO_A_DOCENTE_ID')
            ->where('GRUPO_A_DOCENTE.DOCENTE_ID', '=', $docenteId)
            ->where('CLASE.GESTION_ID', '=', $id_gestion)
            ->orderBy('SESION.SEMANA', 'DESC')
            ->select('SESION.SEMANA')
            ->first();
=======
>>>>>>> origin

            $gruposDocente = GrupoDocente::join('GRUPO_A_DOCENTE', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID', '=', 'GRUPO_DOCENTE.ID')
            ->join('MATERIA', 'MATERIA.ID', '=', 'GRUPO_DOCENTE.MATERIA_ID')
            ->where('GRUPO_A_DOCENTE.DOCENTE_ID', '=', $docenteId)
            ->where('MATERIA.GESTION_ID', '=', $id_gestion)
            ->select('GRUPO_DOCENTE.ID', 'GRUPO_DOCENTE.DETALLE_GRUPO_DOCENTE', 'MATERIA.NOMBRE_MATERIA', 'MATERIA.CODIGO_MATERIA')
            ->get();

<<<<<<< HEAD
            $ultimaSemanaValor = 1;
            if($ultimaSemana != null)
                $ultimaSemanaValor = $ultimaSemana->SEMANA + 1;

            return view('docente.ver.clases')
                ->with('id_gestion', $id_gestion)
                ->with('gestiones', $gestiones)
                ->with('materias', $gruposDocente)
                ->with('ultima_semana', $ultimaSemanaValor);
=======
            return view('docente.ver.clases')
                ->with('id_gestion', $id_gestion)
                ->with('gestiones', $gestiones)
                ->with('materias', $gruposDocente);
>>>>>>> origin
        }
        return redirect('login');
    }

    public function postClases(Request $request){
        $grupo_docente_id = $request->grupo_docente_id;
<<<<<<< HEAD
        $semana_valor = $request->semana_valor;
=======
        //$semana_valor = $request->semana_valor;
>>>>>>> origin
        $gestion_id = $request->gestion_id;
        $usuarioId = $request->cookie('USUARIO_ID');
        $docenteId = Docente::where('USUARIO_ID', '=', $usuarioId)->get()->first()->ID;
        $grupoADoc = GrupoADocente::whereRaw('GRUPO_A_DOCENTE.DOCENTE_ID='.$docenteId.' AND GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID='.$grupo_docente_id)->get()->first();
<<<<<<< HEAD
        //AQUI REVISAR/////////////////////////////
        $clase_id = $grupoADoc->clase->first()->ID;
        ///////////////////////////////////////////
        $nombreArchivo = $request->cookie('USUARIO_ID').'_'.$clase_id.'_'.$semana_valor.'_'.$gestion_id;
        
        return view('docente.subir.practica')
        ->with('nombre_archivo', $nombreArchivo)
        ->with('clase_id', $clase_id)
        ->with('semana_valor', $semana_valor)
        ->with('auxiliar_id', null)
        ->with('gestion_id', $gestion_id);
=======
        
        $guiaPracticaResult = GuiaPractica::orderBy('ID', 'DESC')->first();
        $guiaPracticaId = 1;
        if($guiaPracticaResult !== null)
            $guiaPracticaId = $guiaPracticaResult->ID + 1;

        $nombreArchivo = $request->cookie('USUARIO_ID').'_'.$grupoADoc->ID.'_'.$guiaPracticaId.'_'.$gestion_id;
        
        $ultimaSemana = Sesion::join('CLASE', 'CLASE.ID', '=', 'SESION.CLASE_ID')
        ->join('GRUPO_A_DOCENTE', 'GRUPO_A_DOCENTE.ID', '=', 'CLASE.GRUPO_A_DOCENTE_ID')
        ->where('GRUPO_A_DOCENTE.ID', '=', $grupoADoc->ID)
        ->orderBy('SESION.SEMANA', 'DESC')
        ->select('SESION.SEMANA')
        ->get()->first();

        $ultimaSemanaValor = 1;
            if($ultimaSemana != null)
                $ultimaSemanaValor = $ultimaSemana->SEMANA + 1;

        return view('docente.subir.practica')
        ->with('grupo_a_docente_id', $grupoADoc->ID)
        ->with('semana_valor', $ultimaSemanaValor)
        ->with('auxiliar_id', null)
        ->with('gestion_id', $gestion_id)
        ->with('docente_id', $docenteId)
        ->with('nombre_archivo', $nombreArchivo);
>>>>>>> origin
    }
}