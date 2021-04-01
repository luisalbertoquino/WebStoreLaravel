<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    public $table = "sale";

    public function product() //pasra asociar product con categoria
    {
        return $this->belongsTo('App\producto','idProducto','id');

    }
    public function cliente() //pasra asociar product con categoria
    {

        return $this->belongsTo('App\cliente','idCliente','id');
    }
    public function usuario() //pasra asociar product con categoria
    {

        return $this->belongsTo('App\usuario','idUsuario','id');
    }

    public function documento() //pasra asociar product con categoria
    {
        return $this->belongsTo('App\documento','idDocumento','id');
    }
}
   