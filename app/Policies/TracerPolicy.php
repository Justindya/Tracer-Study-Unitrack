<?php

namespace App\Policies;

use App\Models\User;
use App\Models\tracer;
use Illuminate\Auth\Access\Response;

class TracerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin bisa melihat semua tracer
        if ($user->role === 'admin') {
            return true;
        }

        // Alumni hanya bisa melihat tracer mereka sendiri
        return $user->alumni !== null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, tracer $tracer): bool
    {
        // Admin bisa melihat semua tracer
        if ($user->role === 'admin') {
            return true;
        }

        // Alumni hanya bisa melihat tracer mereka sendiri
        return $user->alumni && $user->alumni->id === $tracer->alumni_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Admin dan alumni bisa membuat tracer
        return $user->role === 'admin' || $user->alumni !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, tracer $tracer): bool
    {
        // Admin bisa update semua tracer
        if ($user->role === 'admin') {
            return true;
        }

        // Alumni hanya bisa update tracer mereka sendiri
        return $user->alumni && $user->alumni->id === $tracer->alumni_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, tracer $tracer): bool
    {
        // Admin bisa delete semua tracer
        if ($user->role === 'admin') {
            return true;
        }

        // Alumni hanya bisa delete tracer mereka sendiri
        return $user->alumni && $user->alumni->id === $tracer->alumni_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, tracer $tracer): bool
    {
        // Hanya admin yang bisa restore
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, tracer $tracer): bool
    {
        // Hanya admin yang bisa force delete
        return $user->role === 'admin';
    }
}
