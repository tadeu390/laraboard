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

        //os providers sempre rodam antes de qualquer operacao, seja ela uma requisicao
        //pelo navegador ou seja ela um comando executado no terminal, portanto é necessário
        //fazer a verificação abaixo. Isto é, se for algo terminal ele simplesmente atribuit
        //ao arraty permissions vazio ([]). É necessário, pois ao se executar o comando
        //migrate pelo terminal, o provider vai ser executado e a Model Permission caso não exista
        //na base de dados irá dar erro e impedir de criar as migrations.
       /*  $permissions = app()->runningInConsole() ? [] : Permission::with('roles')->get();

        foreach ($permissions as $permission) {
            Gate::define($permission->name, function (User $user) use($permission) {
                return $user->hasPermission($permission);
            });
        }

        //executa antes da lógica acima. Com isso permitimos acesso root ao nosso sistema.
        Gate::before(function(User $user, $permission) {
            if($user->hasAnyRoles('admin')) {
                return true;
            }
        }); */
    }
}
