<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Setup;
use Illuminate\Auth\Access\HandlesAuthorization;

class SetupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the setup can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list setups');
    }

    /**
     * Determine whether the setup can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Setup  $model
     * @return mixed
     */
    public function view(User $user, Setup $model)
    {
        return $user->hasPermissionTo('view setups');
    }

    /**
     * Determine whether the setup can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create setups');
    }

    /**
     * Determine whether the setup can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Setup  $model
     * @return mixed
     */
    public function update(User $user, Setup $model)
    {
        return $user->hasPermissionTo('update setups');
    }

    /**
     * Determine whether the setup can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Setup  $model
     * @return mixed
     */
    public function delete(User $user, Setup $model)
    {
        return $user->hasPermissionTo('delete setups');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Setup  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete setups');
    }

    /**
     * Determine whether the setup can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Setup  $model
     * @return mixed
     */
    public function restore(User $user, Setup $model)
    {
        return false;
    }

    /**
     * Determine whether the setup can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Setup  $model
     * @return mixed
     */
    public function forceDelete(User $user, Setup $model)
    {
        return false;
    }
}
