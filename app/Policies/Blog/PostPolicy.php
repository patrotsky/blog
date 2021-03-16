<?php

namespace App\Policies\Blog;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Verificar si un usuario es el autor de un post.
     * Cada vez que creamos un nuevo método dentro de una policy, espera como mínimo un parámetro: el usuario autenticado
     * Como parámetro espera la información del usuario autenticado.
     * Como segundo parámetro, le enviamos la información del Post que queremos verificar.
     * @param \App\Models\User $user
     * @param \App\Models\Post $post
     * @return bool
     */
    public function author(User $user, Post $post): bool
    {
        return $user->id == $post->user_id;
    }


    /**
     * Verificar si la publicación ya ha sido publicada
     * @param \App\Models\User $user
     * @param \App\Models\Post $post
     * @return bool
     */
    public function published(?User $user, Post $post): bool
    {
        return $post->status == 2; //todo: 2 = published
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
