<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Roles based authorization
        Gate::before(
            function ($user, $ability) {
                if ($user->role === 'admin') {
                    return true;
                }
            }
        );

        foreach (self::$permissions as $action => $roles) {
            Gate::define(
                $action,
                function (User $user) use ($roles) {
                    if (in_array($user->role, $roles)) {
                        return true;
                    }
                }
            );
        }
    }
    public static $permissions = [
        'add-product' => ['manager', 'employee'],
        'show-product' => ['manager', 'employee'],
        'create-product' => ['manager'],
        'store-product' => ['manager'],
        'edit-product' => ['manager'],
        'update-product' => ['manager'],
        'destroy-product' => ['manager'],
    ];
}
