<?php

namespace App;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Foundation\Auth\usuario as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class usuario extends Model
{   
    use Notifiable, HasRolesAndPermissions;
    public $table = "users";
    protected $guard_name = 'web';


    public function documento() //pasra asociar product con categoria
    {
        return $this->belongsTo('App\documento','idDocumento','id');
    } 

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
