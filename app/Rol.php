<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public $table = "rol";
    public function permissions(){
        return $this->belongsToMany(Permiso::class,'rol_permisos');
    }

    public function allRolePermissions(){

        return $this->belongsToMany(Permiso::class,'rol_permisos');
    }
}
