<?php

namespace App\Policies;

use App\User;
use App\compra;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingPolicy
{
    use HandlesAuthorization;

    /**superusuario osea el admin */
    public function before($user, $ability){
        if($user->isSuperAdmin()){
            return true;
        }
    }

    /**
     * Determine whether the user can view any compras.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the compra.
     *
     * @param  \App\User  $user
     * @param  \App\compra  $compra
     * @return mixed
     */
    public function view(User $user, compra $compra)
    {
        //
    }

    /**
     * Determine whether the user can create compras.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the compra.
     *
     * @param  \App\User  $user
     * @param  \App\compra  $compra
     * @return mixed
     */
    public function update(User $user, compra $compra)
    {
        //
    }

    /**
     * Determine whether the user can delete the compra.
     *
     * @param  \App\User  $user
     * @param  \App\compra  $compra
     * @return mixed
     */
    public function delete(User $user, compra $compra)
    {
        //
    }

    /**
     * Determine whether the user can restore the compra.
     *
     * @param  \App\User  $user
     * @param  \App\compra  $compra
     * @return mixed
     */
    public function restore(User $user, compra $compra)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the compra.
     *
     * @param  \App\User  $user
     * @param  \App\compra  $compra
     * @return mixed
     */
    public function forceDelete(User $user, compra $compra)
    {
        //
    }
}
