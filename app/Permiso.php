<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    public $table = "permisos";

    public function roles(){
        return 'mechupa trespingos';
        return $this->belongsToMany(Rol::class,'rol_permisos');
    }
}
