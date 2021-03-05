<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class compra extends Model
{
    public $table = "purchase";

    
    public function producto() //pasra asociar product con categoria
    {
        return $this->belongsTo('App\producto','idProducto','id');
    }

    public function proveedor() //pasra asociar product con categoria
    {
        return $this->belongsTo('App\proveedor','idProveedor','id');
    }
}
