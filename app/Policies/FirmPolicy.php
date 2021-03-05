<?php

namespace App\Policies;

use App\Firm;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FirmPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any firms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view any firms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function createPost(User $user, Firm $firm)
    {
      // check if user ownes Business
      $user_owns_firm = $user->firms->where('id', $firm->id)->count();
      // or if user is admin
      return $user->role_id == 1 || $user_owns_firm;
    }

    /**
     * Determine whether the user can view the firm.
     *
     * @param  \App\User  $user
     * @param  \App\Firm  $firm
     * @return mixed
     */
    public function view(User $user, Firm $firm)
    {
      // check if user ownes Business
      $user_owns_firm = $user->firms->where('id', $firm->id)->count();
      // or if user is admin
      return $user->role_id == 1 || $user_owns_firm;
    }

    /**
     * Determine whether the user can create firms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the firm.
     *
     * @param  \App\User  $user
     * @param  \App\Firm  $firm
     * @return mixed
     */
    public function update(User $user, Firm $firm)
    {
      // check if user ownes Business
      $user_owns_firm = $user->firms->where('id', $firm->id)->count();
      // or if user is admin
      return $user->role_id == 1 || $user_owns_firm;
    }

    /**
     * Determine whether the user can delete the firm.
     *
     * @param  \App\User  $user
     * @param  \App\Firm  $firm
     * @return mixed
     */
    public function delete(User $user, Firm $firm)
    {
      // check if user ownes Business
      $user_owns_firm = $user->firms->where('id', $firm->id)->count();
      // or if user is admin
      return $user->role_id == 1 || $user_owns_firm;
    }

    /**
     * Determine whether the user can restore the firm.
     *
     * @param  \App\User  $user
     * @param  \App\Firm  $firm
     * @return mixed
     */
    public function restore(User $user, Firm $firm)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the firm.
     *
     * @param  \App\User  $user
     * @param  \App\Firm  $firm
     * @return mixed
     */
    public function forceDelete(User $user, Firm $firm)
    {
        //
    }
}
