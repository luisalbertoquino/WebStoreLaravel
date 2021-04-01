<?php

namespace App\Policies;

use App\User;
use App\cliente;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    /**superusuario osea el admin */
    public function before($user, $ability){
        if($user->isSuperAdmin()){
            return true;
        }
    }

    /**
     * Determine whether the user can view any clientes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the cliente.
     *
     * @param  \App\User  $user
     * @param  \App\cliente  $cliente
     * @return mixed
     */
    public function view(User $user, cliente $cliente)
    {
        //
    }

    /**
     * Determine whether the user can create clientes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the cliente.
     *
     * @param  \App\User  $user
     * @param  \App\cliente  $cliente
     * @return mixed
     */
    public function update(User $user, cliente $cliente)
    {
        //
    }

    /**
     * Determine whether the user can delete the cliente.
     *
     * @param  \App\User  $user
     * @param  \App\cliente  $cliente
     * @return mixed
     */
    public function delete(User $user, cliente $cliente)
    {
        //
    }

    /**
     * Determine whether the user can restore the cliente.
     *
     * @param  \App\User  $user
     * @param  \App\cliente  $cliente
     * @return mixed
     */
    public function restore(User $user, cliente $cliente)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the cliente.
     *
     * @param  \App\User  $user
     * @param  \App\cliente  $cliente
     * @return mixed
     */
    public function forceDelete(User $user, cliente $cliente)
    {
        //
    }
}
