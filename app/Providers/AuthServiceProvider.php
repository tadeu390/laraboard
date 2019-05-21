<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Produto;
use App\Policies\ProdutoPolicy;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //Produto::class => ProdutoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('CREATE', function ($user, $module_name, $registro = null) {
            return $user->hasPermission('CREATE', $module_name, $registro);
        });

        Gate::define('READ', function ($user, $module_name, $registro = null) {
            return $user->hasPermission('READ', $module_name, $registro);
        });

        Gate::define('UPDATE', function ($user, $module_name, $registro = null) {
            return $user->hasPermission('UPDATE', $module_name, $registro);
        });

        Gate::define('DELETE', function ($user, $module_name, $registro = null) {
            return $user->hasPermission('DELETE', $module_name, $registro);
        });
    }
}
