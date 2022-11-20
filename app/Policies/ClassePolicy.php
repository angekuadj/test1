<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Classe;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the classe can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the classe can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classe  $model
     * @return mixed
     */
    public function view(User $user, Classe $model)
    {
        return true;
    }

    /**
     * Determine whether the classe can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the classe can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classe  $model
     * @return mixed
     */
    public function update(User $user, Classe $model)
    {
        return true;
    }

    /**
     * Determine whether the classe can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classe  $model
     * @return mixed
     */
    public function delete(User $user, Classe $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classe  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the classe can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classe  $model
     * @return mixed
     */
    public function restore(User $user, Classe $model)
    {
        return false;
    }

    /**
     * Determine whether the classe can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Classe  $model
     * @return mixed
     */
    public function forceDelete(User $user, Classe $model)
    {
        return false;
    }
}
