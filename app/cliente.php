<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    public $table = "client";
    
    public function documento() //pasra asociar product con categoria
    {
        return $this->belongsTo('App\documento','idDocumento','id');
    }
} 
