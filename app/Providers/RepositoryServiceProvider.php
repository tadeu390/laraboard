<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    CategoriaRepositoryInterface,
    ProdutoRepositoryInterface,
    UsuarioRepositoryInterface,
    RoleRepositoryInterface,
    PermissionRepositoryInterface,
    ModuleRepositoryInterface,
    AccessRepositoryInterface,
    GroupRepositoryInterface
};


use Illuminate\Support\ServiceProvider;

use App\Repositories\Core\{
    EloquentProdutoRepository,
    EloquentCategoriaRepository,
    EloquentUsuarioRepository,
    EloquentRoleRepository,
    EloquentPermissionRepository,
    EloquentModuleRepository,
    EloquentAccessRepository,
    EloquentGroupRepository
};

/* use App\Repositories\Core\QueryBuilder\{
    QueryBuilderCategoriaRepository
}; */

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProdutoRepositoryInterface::class,
            EloquentProdutoRepository::class
        );

        $this->app->bind(
            CategoriaRepositoryInterface::class,
            EloquentCategoriaRepository::class
        );

        $this->app->bind(
            UsuarioRepositoryInterface::class,
            EloquentUsuarioRepository::class
        );

        $this->app->bind(
            RoleRepositoryInterface::class,
            EloquentRoleRepository::class
        );

        $this->app->bind(
            PermissionRepositoryInterface::class,
            EloquentPermissionRepository::class
        );

        $this->app->bind(
            ModuleRepositoryInterface::class,
            EloquentModuleRepository::class
        );

        $this->app->bind(
            AccessRepositoryInterface::class,
            EloquentAccessRepository::class
        );

        $this->app->bind(
            GroupRepositoryInterface::class,
            EloquentGroupRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
