<?php

namespace App\Policies;

use App\Models\User;
use App\Models\user_event;
use Illuminate\Auth\Access\Response;

class UserEventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Allow all authenticated users to view events
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, user_event $userEvent): bool
    {
        return true; // Allow all authenticated users to view event details
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, user_event $userEvent): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, user_event $userEvent): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, user_event $userEvent): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, user_event $userEvent): bool
    {
        return false;
    }
}
