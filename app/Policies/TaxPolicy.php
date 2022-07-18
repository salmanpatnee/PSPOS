<?php

namespace App\Policies;

use App\Models\Tax;
use App\Models\User;
use App\Permissions\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can(Permission::CAN_VIEW_TAXES);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Tax $tax)
    {
        return $user->can(Permission::CAN_VIEW_TAXES);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can(Permission::CAN_CREATE_TAXES);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Tax $tax)
    {
        return $user->can(Permission::CAN_UPDATE_TAXES);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Tax $tax)
    {
        return $user->can(Permission::CAN_DELETE_TAXES);
    }
}
