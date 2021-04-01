<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    public $table = "category_product";
    public function category() //pasra asociar product con categoria
    {
        return $this->belongsTo('App\categoria','idCategoria','id');
    }
}
