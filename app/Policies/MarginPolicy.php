<?php

namespace App\Policies;

use App\User;
use App\Margin;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarginPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any margins.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->is_active && $user->is_admin;
    }

    /**
     * Determine whether the user can view the margin.
     *
     * @param  \App\User  $user
     * @param  \App\Margin  $margin
     * @return mixed
     */
    public function view(User $user, Margin $margin)
    {
        return $user->is_active && $user->is_admin;
    }

    /**
     * Determine whether the user can create margins.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_active && $user->is_admin;
    }

    /**
     * Determine whether the user can update the margin.
     *
     * @param  \App\User  $user
     * @param  \App\Margin  $margin
     * @return mixed
     */
    public function update(User $user, Margin $margin)
    {
        return $user->is_active && $user->is_admin;
    }

    /**
     * Determine whether the user can delete the margin.
     *
     * @param  \App\User  $user
     * @param  \App\Margin  $margin
     * @return mixed
     */
    public function delete(User $user, Margin $margin)
    {
        return $user->is_active && $user->is_admin;
    }

    /**
     * Determine whether the user can restore the margin.
     *
     * @param  \App\User  $user
     * @param  \App\Margin  $margin
     * @return mixed
     */
    public function restore(User $user, Margin $margin)
    {
        return $user->is_active && $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the margin.
     *
     * @param  \App\User  $user
     * @param  \App\Margin  $margin
     * @return mixed
     */
    public function forceDelete(User $user, Margin $margin)
    {
        return $user->is_active && $user->is_admin;
    }
}
