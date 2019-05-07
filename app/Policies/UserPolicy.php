<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $signedInUser
     * @return mixed
     */
    public function view(User $user, User $signedInUser)
    {
        if ($user->practice_id == $signedInUser->practice_id) {
            return true;
        }
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
     * @param  \App\Models\User  $signedInUser
     * @return mixed
     */
    public function update(User $user, User $signedInUser)
    {
        return $user->is($signedInUser);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $signedInUser
     * @return mixed
     */
    public function delete(User $user, User $signedInUser)
    {
        if ($user->is($signedInUser)) return false;
        if ($user->practice_id == $signedInUser->practice_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $signedInUser
     * @return mixed
     */
    public function restore(User $user, User $signedInUser)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $signedInUser
     * @return mixed
     */
    public function forceDelete(User $user, User $signedInUser)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $signedInUser
     * @return mixed
     */
    public function seeDelete(User $user, User $signedInUser)
    {
        if ($signedInUser->isOfType(User::ADMIN) && $user->is($signedInUser)) {
            return false;
        }

        if ($user->is($signedInUser)) return false;

        if ($signedInUser->isOfType(User::ADMIN)) return true;
    }


}
