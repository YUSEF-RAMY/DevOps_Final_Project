<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAddressPolicy
{
    use HandlesAuthorization;

    public function view(User $user, UserAddress $address)
    {
        return $user->id === $address->user_id;
    }

    public function update(User $user, UserAddress $address)
    {
        return $user->id === $address->user_id;
    }

    public function delete(User $user, UserAddress $address)
    {
        return $user->id === $address->user_id;
    }
}