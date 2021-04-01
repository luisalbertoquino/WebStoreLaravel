<?php

namespace App\Traits;

use App\Rol;
use App\Permiso;

trait HasRolesAndPermissions{

    public function isAdmin(){
        if($this->roles->contains('slug','administrador-main')){
            return true;
        }
    }
 
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


    public function hasRole($role){

        if($this->roles->contains('slug',$role)) {
            return true;
        }else{
        return false;
        }
    }

    public function hasPermission($permiso){

        if($this->permissions->contains('slug',$permiso)) {
            return true;
        }else{
        return false;
        }
    }
}