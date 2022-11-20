<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Salle;
use Illuminate\Auth\Access\HandlesAuthorization;

class SallePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salle can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the salle can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Salle  $model
     * @return mixed
     */
    public function view(User $user, Salle $model)
    {
        return true;
    }

    /**
     * Determine whether the salle can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the salle can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Salle  $model
     * @return mixed
     */
    public function update(User $user, Salle $model)
    {
        return true;
    }

    /**
     * Determine whether the salle can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Salle  $model
     * @return mixed
     */
    public function delete(User $user, Salle $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Salle  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the salle can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Salle  $model
     * @return mixed
     */
    public function restore(User $user, Salle $model)
    {
        return false;
    }

    /**
     * Determine whether the salle can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Salle  $model
     * @return mixed
     */
    public function forceDelete(User $user, Salle $model)
    {
        return false;
    }
}
