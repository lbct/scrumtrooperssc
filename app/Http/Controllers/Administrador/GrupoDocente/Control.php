<?php
namespace App\Http\Controllers\Administrador\GrupoDocente;

use App\Models\Usuario;
use App\Models\GrupoDocente;
use App\Models\GrupoADocente;
use App\Models\Docente;
use App\Models\FechaInscripcion;
use App\Models\Gestion;
use App\Models\Materia;
use App\Models\Clase;
use App\Classes\Colecciones;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class Control extends Base
{
    public function todos(Request $request, $materia_id){
        $grupos_docentes = GrupoDocente::where('materia_id', $materia_id)
                           ->select('id', 'materia_id', 'detalle_grupo_docente')
                           ->get();
        
        foreach($grupos_docentes as $grupo_docente){
            $cantidad_horarios = Clase::where('grupo_docente_id', $grupo_docente->id)->count();
            $grupo_docente['cantidad_horarios'] = $cantidad_horarios;
            $grupo_docente['borrable'] = $grupo_docente->esBorrable();
        }
        
        return $grupos_docentes;
    }
    
    public function informacion(Request $request, $grupo_docente_id){
        $grupo_docente = GrupoDocente::where('grupo_docente.id', $grupo_docente_id)
                         ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                         ->join('gestion', 'gestion.id', '=', 'materia.gestion_id')
                         ->join('periodo', 'periodo.id', '=', 'gestion.periodo_id')
                         ->select('grupo_docente.id', 'detalle_grupo_docente', 'codigo_materia', 'nombre_materia', 'anho_gestion', 'periodo.descripcion as periodo', 'gestion_id')
                         ->first();
        
        return $grupo_docente;        
    }
    
    public function docentes(Request $request, $grupo_docente_id){
        $grupo_docente = GrupoDocente::where('grupo_docente.id', $grupo_docente_id)
                         ->join('grupo_a_docente', 'grupo_a_docente.grupo_docente_id', '=', 'grupo_docente.id')
                         ->join('docente', 'docente.id', '=', 'grupo_a_docente.docente_id')
                         ->join('usuario', 'usuario.id', '=', 'docente.usuario_id')
                         ->select('docente.id', 'nombre', 'apellido')
                         ->get();
        
        return $grupo_docente;        
    }
    
    public function docentesDisponibles(Request $request, $materia_id){
        $docentes_registrados = GrupoDocente::where('materia_id', $materia_id)
                                ->join('grupo_a_docente', 'grupo_a_docente.grupo_docente_id', '=', 'grupo_docente.id')
                                ->join('docente', 'docente.id', '=', 'grupo_a_docente.docente_id')
                                ->join('usuario', 'usuario.id', '=', 'docente.usuario_id')
                                ->select('docente.id', 'nombre', 'apellido')
                                ->get();
        
        $todos_docentes       = Docente::join('usuario', 'usuario.id', '=', 'docente.usuario_id')
                                ->select('docente.id', 'nombre', 'apellido')
                                ->get();
        
        $docentes_disponibles = Colecciones::diferenciaPorId($todos_docentes, $docentes_registrados);
        
        return $docentes_disponibles;        
    }
    
    public function agregarGrupoDocente(Request $request){
        $docentes   = $request->docentes;
        $materia_id = $request->materia_id;
        
        $grupo_docente = new GrupoDocente;
        $grupo_docente->materia_id = $materia_id;
        $grupo_docente->save();
        
        $detalle_docente = '';
        
        $docentes_agregados = 0;
        $docentes_totales=0;
        
        $materia = Materia::find($materia_id);
        foreach($docentes as $docente){
            $docentes_totales++;
            if(!$materia->tieneDocente($docente['id'])){
                $grupo_a_docente = new GrupoADocente;
                $grupo_a_docente->grupo_docente_id = $grupo_docente->id;
                $grupo_a_docente->docente_id       = $docente['id'];
                $grupo_a_docente->save();
                
                $docentes_agregados++;
            }
        }
        
        $detalle_docente = $grupo_docente->generarDetalle();
        
        if($detalle_docente != ''){
            $grupo_docente->detalle_grupo_docente = $detalle_docente;
            $grupo_docente->save();
            
            if($docentes_totales == $docentes_agregados)
                return response()->json(['exito'=>["Grupo Docente añadido con éxito."]], 200);
            else
                return response()->json(['advertencia'=>["Grupo Docente añadido, sin embargo algunos docentes ya pertenecen a otro grupo de la misma materia, estos no fueron agregados."]], 200);
        }
        else{
            $grupo_docente->delete();
            return response()->json(['error'=>["Los docentes indicados ya pertenecen a otro grupo de la misma materia."]], 200);
        }
    }
    
    public function borrarGrupoDocente(Request $request){
        $grupo_docente_id = $request->grupo_docente_id;
        
        $grupo_docente = GrupoDocente::find($grupo_docente_id);
        if($grupo_docente)
            $grupo_docente->delete();        
        
        return response()->json(['exito'=>["Grupo Docente eliminado con éxito."]], 200);
    }
    
    public function editarGrupoDocente(Request $request){
        $grupo_docente_id = $request->grupo_docente_id;
        $docentes         = $request->docentes;
        
        $grupo_docente = GrupoDocente::find($grupo_docente_id);
        
        if($grupo_docente){
            $materia = Materia::find($grupo_docente->materia_id);
            $grupos_a_docentes = GrupoADocente::where('grupo_docente_id', $grupo_docente_id)
                                 ->get();
            
            $docentes_eliminados = collect();
            
            foreach($grupos_a_docentes as $grupo_a_docente){
                $encontrado = false;
                
                foreach($docentes as $docente){
                    if($grupo_a_docente->docente_id == $docente['id']){
                        $encontrado = true;
                        break;
                    }
                }
                
                if(!$encontrado){
                    $docentes_eliminados->push($grupo_a_docente->docente_id);
                    $registro = GrupoADocente::find($grupo_a_docente->id);
                    $registro->delete();
                } 
            }
            
            foreach($docentes as $docente){
                $grupo_a_docente = GrupoADocente::where('grupo_docente_id', $grupo_docente_id)
                                   ->where('docente_id', $docente['id'])
                                   ->first();
                
                if(!$grupo_a_docente){
                    if(!$materia->tieneDocente($docente['id'])){
                        $grupo_a_docente = new GrupoADocente;
                        $grupo_a_docente->grupo_docente_id = $grupo_docente_id;
                        $grupo_a_docente->docente_id       = $docente['id'];
                        $grupo_a_docente->save();
                    }
                }
            }
            
            $detalle_docente = $grupo_docente->generarDetalle();
        
            if($detalle_docente != ''){
                $grupo_docente->detalle_grupo_docente = $detalle_docente;
                $grupo_docente->save();
                
                return response()->json(['exito'=>["Grupo Docente editado con éxito."]], 200);
            }
            else{
                $grupo_docente->delete();
                return response()->json(['error'=>["Los docentes indicados ya pertenecen a otro grupo de la misma materia."]], 200);
            }
                
        }
        return response()->json(['error'=>["Grupo Docente eliminado antes la acción."]], 200);
    }
}