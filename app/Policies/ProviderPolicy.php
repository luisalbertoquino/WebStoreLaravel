<?php

namespace App\Policies;

use App\User;
use App\proveedor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProviderPolicy
{
    use HandlesAuthorization;

    /**superusuario osea el admin */
    public function before($user, $ability){
        if($user->isSuperAdmin()){
            return true;
        }
    }

    /**
     * Determine whether the user can view any proveedors.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\proveedor  $proveedor
     * @return mixed
     */
    public function view(User $user, proveedor $proveedor)
    {
        //
    }

    /**
     * Determine whether the user can create proveedors.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\proveedor  $proveedor
     * @return mixed
     */
    public function update(User $user, proveedor $proveedor)
    {
        //
    }

    /**
     * Determine whether the user can delete the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\proveedor  $proveedor
     * @return mixed
     */
    public function delete(User $user, proveedor $proveedor)
    {
        //
    }

    /**
     * Determine whether the user can restore the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\proveedor  $proveedor
     * @return mixed
     */
    public function restore(User $user, proveedor $proveedor)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\proveedor  $proveedor
     * @return mixed
     */
    public function forceDelete(User $user, proveedor $proveedor)
    {
        //
    }
}
