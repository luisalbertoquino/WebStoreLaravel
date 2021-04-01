<?php

namespace App\Policies;

use App\User;
use App\venta;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    /**superusuario osea el admin */
    public function before($user, $ability){
        if($user->isSuperAdmin()){
            return true;
        }
    }

    /**
     * Determine whether the user can view any ventas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the venta.
     *
     * @param  \App\User  $user
     * @param  \App\venta  $venta
     * @return mixed
     */
    public function view(User $user, venta $venta)
    {
        //
    }

    /**
     * Determine whether the user can create ventas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        
    }

    public function edit(User $user, venta $venta)
    {
        if($venta->idUsuario == $user->id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the venta.
     *
     * @param  \App\User  $user
     * @param  \App\venta  $venta
     * @return mixed
     */
    public function update(User $user, venta $venta)
    {
        if($venta->idUsuario == $user->id ){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the venta.
     *
     * @param  \App\User  $user
     * @param  \App\venta  $venta
     * @return mixed
     */
    public function delete(User $user, venta $venta)
    {
        //
    }

    /**
     * Determine whether the user can restore the venta.
     *
     * @param  \App\User  $user
     * @param  \App\venta  $venta
     * @return mixed
     */
    public function restore(User $user, venta $venta)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the venta.
     *
     * @param  \App\User  $user
     * @param  \App\venta  $venta
     * @return mixed
     */
    public function forceDelete(User $user, venta $venta)
    {
        //
    }
}
