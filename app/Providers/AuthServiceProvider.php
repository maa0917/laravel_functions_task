<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        // Gateを使った認可
        // $gate->define('user-access', function (User $user, $id) {
        //     return intval($user->getAuthIdentifier() === intval($id));
        // });
    }
}
