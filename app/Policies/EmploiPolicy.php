<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Emploi;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmploiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the emploi can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the emploi can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Emploi  $model
     * @return mixed
     */
    public function view(User $user, Emploi $model)
    {
        return true;
    }

    /**
     * Determine whether the emploi can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the emploi can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Emploi  $model
     * @return mixed
     */
    public function update(User $user, Emploi $model)
    {
        return true;
    }

    /**
     * Determine whether the emploi can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Emploi  $model
     * @return mixed
     */
    public function delete(User $user, Emploi $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Emploi  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the emploi can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Emploi  $model
     * @return mixed
     */
    public function restore(User $user, Emploi $model)
    {
        return false;
    }

    /**
     * Determine whether the emploi can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Emploi  $model
     * @return mixed
     */
    public function forceDelete(User $user, Emploi $model)
    {
        return false;
    }
}
