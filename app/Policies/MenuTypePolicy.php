<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MenuType;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the menuType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list menutypes');
    }

    /**
     * Determine whether the menuType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MenuType  $model
     * @return mixed
     */
    public function view(User $user, MenuType $model)
    {
        return $user->hasPermissionTo('view menutypes');
    }

    /**
     * Determine whether the menuType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create menutypes');
    }

    /**
     * Determine whether the menuType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MenuType  $model
     * @return mixed
     */
    public function update(User $user, MenuType $model)
    {
        return $user->hasPermissionTo('update menutypes');
    }

    /**
     * Determine whether the menuType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MenuType  $model
     * @return mixed
     */
    public function delete(User $user, MenuType $model)
    {
        return $user->hasPermissionTo('delete menutypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MenuType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete menutypes');
    }

    /**
     * Determine whether the menuType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MenuType  $model
     * @return mixed
     */
    public function restore(User $user, MenuType $model)
    {
        return false;
    }

    /**
     * Determine whether the menuType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MenuType  $model
     * @return mixed
     */
    public function forceDelete(User $user, MenuType $model)
    {
        return false;
    }
}
