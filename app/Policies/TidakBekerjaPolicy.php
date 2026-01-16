<?php

namespace App\Policies;

use App\Models\User;
use App\Models\tidak_bekerja;
use Illuminate\Auth\Access\Response;

class TidakBekerjaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, tidak_bekerja $tidakBekerja): bool
    {
        return false;
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
    public function update(User $user, tidak_bekerja $tidakBekerja): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, tidak_bekerja $tidakBekerja): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, tidak_bekerja $tidakBekerja): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, tidak_bekerja $tidakBekerja): bool
    {
        return false;
    }
}
