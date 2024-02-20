<?php

namespace App\Policies;

use Modules\User\src\Model\User;
use Modules\Group\src\Model\Group;
use Illuminate\Auth\Access\Response;

class GroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Group $group)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Group $group)
    {
        return $group->name != 'Administrator';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Group $group)
    {
        return $group->name != 'Administrator';
    }

    public function permission(User $user, Group $group)
    {
        return $group->name != 'Administrator';
        // return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Group $group)
    {
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Group $group)
    {
        //
    }
}
