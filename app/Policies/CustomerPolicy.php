<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use App\Permissions\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
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
        return $user->can(Permission::CAN_VIEW_CUSTOMERS);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Customer $Customer)
    {
        return $user->can(Permission::CAN_VIEW_CUSTOMERS);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can(Permission::CAN_CREATE_CUSTOMERS);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Customer $Customer)
    {
        return $user->can(Permission::CAN_UPDATE_CUSTOMERS);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Customer $Customer)
    {
        return $user->can(Permission::CAN_DELETE_CUSTOMERS);
    }
}
