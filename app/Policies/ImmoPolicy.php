<?php

namespace App\Policies;

use App\Models\Immobilier;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;


class ImmoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Immobilier $immobilier): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Immobilier $immobilier): bool
    {
    return $user->id === $immobilier->owner_id;
     }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Immobilier $immobilier): bool
    {
        $user = Auth::user();
        return $user->id === $immobilier->owner_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Immobilier $immobilier): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Immobilier $immobilier): bool
    {
        //
    }
}
