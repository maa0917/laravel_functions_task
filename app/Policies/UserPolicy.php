<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $currentUser
     * @param User $targetUser
     * @return int
     */
    public function view(User $currentUser, User $targetUser): int
    {
        return intval($currentUser->getAuthIdentifier() === intval($targetUser->id));
    }
}
