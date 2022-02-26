<?php

namespace App\Policies;

use App\Models\Ads;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->checkPermessionAccess('ads_list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ads  $ads
     * @return mixed
     */
    public function view(User $user, Ads $ads)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermessionAccess('ads_add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ads  $ads
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermessionAccess('ads_edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ads  $ads
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->checkPermessionAccess('ads_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ads  $ads
     * @return mixed
     */
    public function restore(User $user, Ads $ads)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ads  $ads
     * @return mixed
     */
    public function forceDelete(User $user, Ads $ads)
    {
        //
    }
}
