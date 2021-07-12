<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OrderCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the orderCategory can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list ordercategories');
    }

    /**
     * Determine whether the orderCategory can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderCategory  $model
     * @return mixed
     */
    public function view(User $user, OrderCategory $model)
    {
        return $user->hasPermissionTo('view ordercategories');
    }

    /**
     * Determine whether the orderCategory can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create ordercategories');
    }

    /**
     * Determine whether the orderCategory can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderCategory  $model
     * @return mixed
     */
    public function update(User $user, OrderCategory $model)
    {
        return $user->hasPermissionTo('update ordercategories');
    }

    /**
     * Determine whether the orderCategory can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderCategory  $model
     * @return mixed
     */
    public function delete(User $user, OrderCategory $model)
    {
        return $user->hasPermissionTo('delete ordercategories');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderCategory  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete ordercategories');
    }

    /**
     * Determine whether the orderCategory can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderCategory  $model
     * @return mixed
     */
    public function restore(User $user, OrderCategory $model)
    {
        return false;
    }

    /**
     * Determine whether the orderCategory can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderCategory  $model
     * @return mixed
     */
    public function forceDelete(User $user, OrderCategory $model)
    {
        return false;
    }
}
