<?php

namespace App\Policies;

use App\Models\Therapy_room;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Therapy_roomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        return $user->is_admin($user->role_id);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Therapy_room  $therapyRoom
     * @return mixed
     */
    public function view(User $user, Therapy_room $therapyRoom)
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
        return $user->is_admin($user->role_id);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Therapy_room  $therapyRoom
     * @return mixed
     */
    public function update(User $user, Therapy_room $therapyRoom)
    {
        //
        return $user->is_admin($user->role_id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Therapy_room  $therapyRoom
     * @return mixed
     */
    public function delete(User $user, Therapy_room $therapyRoom)
    {
        //
        return $user->is_admin($user->role_id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Therapy_room  $therapyRoom
     * @return mixed
     */
    public function restore(User $user, Therapy_room $therapyRoom)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Therapy_room  $therapyRoom
     * @return mixed
     */
    public function forceDelete(User $user, Therapy_room $therapyRoom)
    {
        //
    }
}
