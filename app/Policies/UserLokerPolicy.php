<?php

namespace App\Policies;

use App\Models\User;
use App\Models\user_loker;
use Illuminate\Auth\Access\Response;

class UserLokerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Allow all authenticated users to view job listings
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, user_loker $userLoker): bool
    {
        return true;
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
    public function update(User $user, user_loker $userLoker): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, user_loker $userLoker): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, user_loker $userLoker): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, user_loker $userLoker): bool
    {
        return false;
    }
}
