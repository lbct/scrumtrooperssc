<?php

namespace App\Models;

use App\Models\AsignaRol;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'usuario';
    protected $hidden = array('password', 'created_at', 'updated_at');
    
    public function administrador()
    {
        return $this->hasOne('App\Models\Administrador', 'usuario_id', 'id');
    }
    
    public function docente()
    {
        return $this->hasOne('App\Models\Docente', 'usuario_id', 'id');
    }
    
    public function auxiliar()
    {
        return $this->hasOne('App\Models\Auxiliar', 'usuario_id', 'id');
    }
    
    public function estudiante()
    {
        return $this->hasOne('App\Models\Estudiante', 'usuario_id', 'id');
    }
    
    public function iniciarSesion()
    {
        return $this->hasMany('App\Models\IniciarSesion', 'usuario_id', 'id');
    }
    
    public function asignaRol()
    {
        return $this->hasMany('App\Models\AsignaRol', 'usuario_id', 'id');
    }
    
    public function revisarPassword($password)
    {
        $hashedPassword  = $this->password;
        $igual           = false;
        
        if( Hash::check($password, $hashedPassword) )
            $igual = true;
        
        return $igual;
    }
    
    public function tieneRol($rol)
    {
        $tiene_rol = false;
        
        $rol = AsignaRol::where("rol_id", $rol)
               ->where("usuario_id", $this->id)
               ->first();
        
        if($rol)
            $tiene_rol = true;
        
        return $tiene_rol;
    }
    
    public function roles()
    {
        $roles = AsignaRol::where('usuario_id', $this->id)
                     ->join('rol', 'rol.id', '=', 'asigna_rol.rol_id')
                     ->select('rol_id as id', 'descripcion')
                     ->get();
        
        return $roles;
    }
}
