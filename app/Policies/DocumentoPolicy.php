<?php

namespace App\Policies;

use App\User;
use App\documento;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentoPolicy
{
    use HandlesAuthorization;

    /**superusuario osea el admin */
    public function before($user, $ability){
        if($user->isSuperAdmin()){
            return true;
        }
    }

    /**
     * Determine whether the user can view any documentos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the documento.
     *
     * @param  \App\User  $user
     * @param  \App\documento  $documento
     * @return mixed
     */
    public function view(User $user, documento $documento)
    {
        //
    }

    /**
     * Determine whether the user can create documentos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the documento.
     *
     * @param  \App\User  $user
     * @param  \App\documento  $documento
     * @return mixed
     */
    public function update(User $user, documento $documento)
    {
        //
    }

    /**
     * Determine whether the user can delete the documento.
     *
     * @param  \App\User  $user
     * @param  \App\documento  $documento
     * @return mixed
     */
    public function delete(User $user, documento $documento)
    {
        //
    }

    /**
     * Determine whether the user can restore the documento.
     *
     * @param  \App\User  $user
     * @param  \App\documento  $documento
     * @return mixed
     */
    public function restore(User $user, documento $documento)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the documento.
     *
     * @param  \App\User  $user
     * @param  \App\documento  $documento
     * @return mixed
     */
    public function forceDelete(User $user, documento $documento)
    {
        //
    }
}
