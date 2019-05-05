<?php
namespace App\Http\Controllers\Auxiliar\Ver;

use App\Models\Usuario;
use App\Models\Auxiliar;
use App\Models\Sesion;
use App\Models\Gestion;
use App\Models\GuiaPractica;
use App\Models\GrupoDocenteAuxiliar;
use App\Models\GrupoADocente;
use App\Models\Clase;
use App\Models\EstudianteClase;
use App\Models\Estudiante;
use App\Models\SesionEstudiante;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auxiliar\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{    
    //Obtiene la vista de las clases del Auxiliar
    public function getClases(Request $request, $id_gestion)
    {
        if($this->rol->is($request))
        {
            $gestiones = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->get();
            $id_auxiliar = Auxiliar::where('USUARIO_ID', '=', $request->cookie('USUARIO_ID'))->first()->ID;

            $grupos_docentes = GrupoDocenteAuxiliar::where('AUXILIAR_ID', '=', $id_auxiliar)->get();

            $ids_clases = GrupoDocenteAuxiliar::where('AUXILIAR_ID', '=', $id_auxiliar)
            ->join('GRUPO_DOCENTE', 'GRUPO_DOCENTE.ID', '=', 'GRUPO_DOCENTE_AUXILIAR.GRUPO_DOCENTE_ID')
            ->join('GRUPO_A_DOCENTE', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID', '=', 'GRUPO_DOCENTE.ID')
            ->join('CLASE', 'CLASE.GRUPO_A_DOCENTE_ID', '=', 'GRUPO_A_DOCENTE.ID')
            ->join('HORARIO', 'HORARIO.ID', '=', 'CLASE.HORARIO_ID')
            ->where('CLASE.GESTION_ID', '=', $id_gestion)
            ->orderByRaw('CLASE.DIA asc, HORARIO.HORA_INICIO asc')
            ->select('CLASE.ID')
            ->get();
            
            $clases = [];
            foreach($ids_clases as $id_clase){
                array_push($clases, Clase::find($id_clase->ID));
            }

            return view('auxiliar.ver.clases')
            ->with('id_gestion', $id_gestion)
            ->with('gestiones', $gestiones)
            ->with('clases', $clases);
        }
        return redirect('login');
    }

    //Guarda la asistencia del estudiante
    public function postClases(Request $request)
    {
        if($this->rol->is($request))
        {
            $est_clases = EstudianteClase::where('CLASE_ID', '=', $request->clase_id)->get();
            $id_gestion = Clase::find($request->clase_id)->gestion->ID;
            $auxiliar = Auxiliar::where('USUARIO_ID', '=', $request->cookie('USUARIO_ID'))->first();
            $sesiones = Sesion::whereRaw('AUXILIAR_ID='.$auxiliar->ID.' AND CLASE_ID='.$request->clase_id)->orderBy('ID', 'DESC')->get();
            $sesion_id = -1;
            if($request->sesion_id != null){
                $sesion_id = $request->sesion_id;
            }
            else if($sesiones != null && sizeof($sesiones) > 0){
                $sesion_id = $sesiones->first()->ID;
            }
            
            if($request->estudiante_id != null){
                $estudiante = Estudiante::find($request->estudiante_id);
                $sesion_est = SesionEstudiante::whereRaw('SESION_ID='.$sesion_id.' AND ESTUDIANTE_ID='.$estudiante->ID)->first();
                
                if($sesion_est == null)
                    $sesion_est = new SesionEstudiante();
                $sesion_est->SESION_ID = $sesion_id;
                $sesion_est->ESTUDIANTE_ID = $estudiante->ID;
                $sesion_est->ASISTENCIA_SESION = $request->asiste == null ? 0 : 1;
                $sesion_est->save();
            }
            $estudiantes = [];
            foreach($est_clases as $est_clase){
                array_push($estudiantes, $est_clase->estudiante);
            }
            if($sesion_id != -1){
                return view('auxiliar.estudiante.ver.lista')
                ->with('estudiantes', $estudiantes)
                ->with('sesiones', $sesiones)
                ->with('sesion_id', $sesion_id)
                ->with('clase_id', $request->clase_id)
                ->with('id_gestion', $id_gestion);
            }
            else{
                $request->session()->flash('alert-danger', 'No existen sesiones para la clase seleccionada.');
                return redirect('/auxiliar/clases/'.$id_gestion);
            }
        }
        return redirect('login');
    }

    //Obtiene la vista de clases de la última Gestión
    public function getClasesUltimaGestion(Request $request)
    {
        if($this->rol->is($request))
        {
            $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
            return $this->getClases($request, $id_gestion);
        }
        return redirect('login');
    }

    //Obtiene la vista de clases de la última Gestión
    public function getPracticasUltimaGestion(Request $request)
    {
        if($this->rol->is($request))
        {
            $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
            return $this->getPracticas($request, $id_gestion);
        }
        return redirect('login');
    }

    //Obtiene la vista de las Practicas del Auxiliar
    public function getPracticas(Request $request, $id_gestion)
    {
        if($this->rol->is($request))
        {
            $gestiones = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->get();
            $id_auxiliar = Auxiliar::where('USUARIO_ID', '=', $request->cookie('USUARIO_ID'))->first()->ID;

            $grupos_docentes = GrupoDocenteAuxiliar::where('AUXILIAR_ID', '=', $id_auxiliar)->get();

            $ids_clases = GrupoDocenteAuxiliar::where('AUXILIAR_ID', '=', $id_auxiliar)
            ->join('GRUPO_DOCENTE', 'GRUPO_DOCENTE.ID', '=', 'GRUPO_DOCENTE_AUXILIAR.GRUPO_DOCENTE_ID')
            ->join('GRUPO_A_DOCENTE', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID', '=', 'GRUPO_DOCENTE.ID')
            ->join('CLASE', 'CLASE.GRUPO_A_DOCENTE_ID', '=', 'GRUPO_A_DOCENTE.ID')
            ->join('HORARIO', 'HORARIO.ID', '=', 'CLASE.HORARIO_ID')
            ->where('CLASE.GESTION_ID', '=', $id_gestion)
            ->orderByRaw('CLASE.DIA asc, HORARIO.HORA_INICIO asc')
            ->select('CLASE.ID')
            ->get();
            
            $clases = [];
            foreach($ids_clases as $id_clase){
                array_push($clases, Clase::find($id_clase->ID));
            }

            return view('auxiliar.ver.practicas')
            ->with('id_gestion', $id_gestion)
            ->with('gestiones', $gestiones)
            ->with('clases', $clases);
        }
        return redirect('login');
    }

    public function postPracticas(Request $request)
    {
        if($this->rol->is($request))
        {
            $id_gestion = Clase::find($request->clase_id)->gestion->ID;
            $auxiliar = Auxiliar::where('USUARIO_ID', '=', $request->cookie('USUARIO_ID'))->first();
            $sesiones = Sesion::whereRaw('AUXILIAR_ID='.$auxiliar->ID.' AND CLASE_ID='.$request->clase_id)->orderBy('ID', 'DESC')->get();
            $sesion_id = -1;
            if($request->sesion_id != null){
                $sesion_id = $request->sesion_id;
            }
            else if($sesiones != null && sizeof($sesiones) > 0){
                $sesion_id = $sesiones->first()->ID;
            }
            
            if($sesion_id != -1){
                $sesion = Sesion::where('SESION.ID', '=', $sesion_id)->first();
                $practica = GuiaPractica::where('GUIA_PRACTICA.ID', '=', $sesion->GUIA_PRACTICA_ID)->first();
                return view('auxiliar.practica.ver.lista')
                ->with('practica', $practica)
                ->with('sesiones', $sesiones)
                ->with('sesion_id', $sesion_id)
                ->with('clase_id', $request->clase_id)
                ->with('id_gestion', $id_gestion);
            }
            else{
                $request->session()->flash('alert-danger', 'No existen sesiones para la clase seleccionada.');
                return redirect('/auxiliar/practicas/'.$id_gestion);
            }
        }
        return redirect('login');
    }
}