<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Produto;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProdutoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the produto.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Produto  $produto
     * @return mixed
     */
    public function view(User $user, Produto $produto)
    {
        //
    }

    /**
     * Determine whether the user can create produtos.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the produto.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Produto  $produto
     * @return mixed
     */
    public function update(User $user, Produto $produto)
    {
        return $user->id === $produto->user_id;
    }

    /**
     * Determine whether the user can delete the produto.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Produto  $produto
     * @return mixed
     */
    public function delete(User $user, Produto $produto)
    {
        //
    }

    /**
     * Determine whether the user can restore the produto.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Produto  $produto
     * @return mixed
     */
    public function restore(User $user, Produto $produto)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the produto.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Produto  $produto
     * @return mixed
     */
    public function forceDelete(User $user, Produto $produto)
    {
        //
    }
}
