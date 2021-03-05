<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    public $table = "provider";

    public function document() //pasra asociar product con categoria
    {
        return $this->belongsTo('App\documento','idDocumento','id');
    }
}
