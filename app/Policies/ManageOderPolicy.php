<?php

namespace App\Policies;

use App\Oder;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManageOderPolicy
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
        return $user->checkPermessionAccess('ManageOder_list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Oder  $oder
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermessionAccess('ManageOder_show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Oder  $oder
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermessionAccess('ManageOder_edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Oder  $oder
     * @return mixed
     */
    public function delete(User $user)
    {
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Oder  $oder
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Oder  $oder
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }

    public function print(User $user)
    {
        return $user->checkPermessionAccess('ManageOder_print');
    }
}
