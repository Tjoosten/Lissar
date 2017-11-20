<?php

namespace App\Policies;

use App\User;
use App\ApiKeys;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApiKeyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the apiKeys.
     *
     * @param  \App\User     $user
     * @param  \App\ApiKeys  $apiKeys
     * @return mixed
     */
    public function delete(User $user, ApiKeys $apiKeys)
    {
        return  $apiKeys->apikeyable_id == $user->id || $user->hasRole('admin');
    }
}
