<?php

namespace App\Policies;

use App\Models\Prof;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the prof can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the prof can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prof  $model
     * @return mixed
     */
    public function view(User $user, Prof $model)
    {
        return true;
    }

    /**
     * Determine whether the prof can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the prof can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prof  $model
     * @return mixed
     */
    public function update(User $user, Prof $model)
    {
        return true;
    }

    /**
     * Determine whether the prof can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prof  $model
     * @return mixed
     */
    public function delete(User $user, Prof $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prof  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the prof can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prof  $model
     * @return mixed
     */
    public function restore(User $user, Prof $model)
    {
        return false;
    }

    /**
     * Determine whether the prof can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Prof  $model
     * @return mixed
     */
    public function forceDelete(User $user, Prof $model)
    {
        return false;
    }
}
