<?php

namespace App\Policies;

use App\User;
use App\producto;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;
    
    /**superusuario osea el admin */
    public function before($user, $ability){
        if($user->isSuperAdmin()){
            return true;
        }
    }

    /**
     * Determine whether the user can view any productos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the producto.
     *
     * @param  \App\User  $user
     * @param  \App\producto  $producto
     * @return mixed
     */
    public function view(User $user, producto $producto)
    {
        //
    }

    /**
     * Determine whether the user can create productos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    public function edit(User $user, producto $producto){

        
        return false;
    }
    

    /**
     * Determine whether the user can update the producto.
     *
     * @param  \App\User  $user
     * @param  \App\producto  $producto
     * @return mixed
     */
    public function update(User $user, producto $producto)
    {
        if($user->roles->contains('slug','administrador-main')){
            return true;
        }elseif($user->permissions->contains('slug', 'UpdateProduct')){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the producto.
     *
     * @param  \App\User  $user
     * @param  \App\producto  $producto
     * @return mixed
     */
    public function delete(User $user, producto $producto)
    {
        //
    }

    /**
     * Determine whether the user can restore the producto.
     *
     * @param  \App\User  $user
     * @param  \App\producto  $producto
     * @return mixed
     */
    public function restore(User $user, producto $producto)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the producto.
     *
     * @param  \App\User  $user
     * @param  \App\producto  $producto
     * @return mixed
     */
    public function forceDelete(User $user, producto $producto)
    {
        //
    }
}
