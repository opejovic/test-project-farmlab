<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $vet
     * @return mixed
     */
    public function view(User $user, User $vet)
    {
        return $user->practice_id == $vet->practice_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $vet
     * @return mixed
     */
    public function delete(User $user, User $vet)
    {
        return $user->practice_id == $vet->practice_id;
    }
}
