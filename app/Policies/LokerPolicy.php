<?php

namespace App\Policies;

use App\Models\User;
use App\Models\loker;
use Illuminate\Auth\Access\Response;

class LokerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true; // Allow all users to view listings
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, loker $loker): bool
    {
        return true; // Allow all users to view individual listings
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool
    {
        return true; // Allow any user to create
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, loker $loker): bool
    {
        return true; // Allow any user to update
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, loker $loker): bool
    {
       return true; // Allow any user to delete
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(?User $user, loker $loker): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(?User $user, loker $loker): bool
    {
        return true;
    }
}
