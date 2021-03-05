<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    public $table = "product"; 

    public function category() //pasra asociar product con categoria
    {
        return $this->belongsTo('App\categoria','idCategoria','id');
    }
    public function cambiarEstado()
    {
         
    } 
}
