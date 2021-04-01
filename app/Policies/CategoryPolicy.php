<?php

namespace App\Policies;

use App\User;
use App\categoria;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**superusuario osea el admin */
    public function before($user, $ability){
        if($user->isAdmin()){
            return true;
        }
    }

    /**
     * Determine whether the user can view any categorias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the categoria.
     *
     * @param  \App\User  $user
     * @param  \App\categoria  $categoria
     * @return mixed
     */
    public function viewCategory(User $user)
    {
        if($user->permissions->contains('slug', 'viewcategory')){
            return true;
        }else{
            return false;
        }
        
    }
    public function editCategory(User $user){
        return false;
    }

    /**
     * Determine whether the user can create categorias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function createCategory(User $user)
    {
        if($user->permissions->contains('slug', 'createcategory')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can update the categoria.
     *
     * @param  \App\User  $user
     * @param  \App\categoria  $categoria
     * @return mixed
     */
    public function updateCategory(User $user, categoria $categoria)
    {
        if($user->permissions->contains('slug', 'updatecategory')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the categoria.
     *
     * @param  \App\User  $user
     * @param  \App\categoria  $categoria
     * @return mixed
     */
    public function delete(User $user, categoria $categoria)
    {
        
    }

    public function down(User $user, categoria $categoria)
    {
        if($user->permissions->contains('slug', 'DownCategory')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can restore the categoria.
     *
     * @param  \App\User  $user
     * @param  \App\categoria  $categoria
     * @return mixed
     */
    public function restore(User $user, categoria $categoria)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the categoria.
     *
     * @param  \App\User  $user
     * @param  \App\categoria  $categoria
     * @return mixed
     */ 
    public function forceDelete(User $user, categoria $categoria)
    {
        //
    }
}
