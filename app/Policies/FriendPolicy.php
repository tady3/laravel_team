<?php

namespace App\Policies;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FriendPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

        /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Friend $friend, User $user)
    {
        return true;
    }
}
