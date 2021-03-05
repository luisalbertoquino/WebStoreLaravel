<?php

namespace App\Traits;

use App\Rol;
use App\Permiso;

trait HasRolesAndPermissions{
 
    /**
    *@return mixed
    */
    public function roles(){
        return $this->belongsToMany(Rol::class,'user_rol');
    }
 
    /** 
    *@return mixed
    */

    public function permissions(){
        return $this->belongsToMany(Permiso::class,'user_permisos');
    }
}