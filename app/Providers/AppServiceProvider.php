<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Categoria;
use App\Models\AccessLevel;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'admin.produtos.*',
            function ($view) {
                $view->with('categorias', Categoria::pluck('title', 'id')->toArray());

                $view->atributos = [];
                foreach (Categoria::pluck('title', 'id') as $key => $item) {
                    $view->atributos[$key] = ['title' => $item];
                }
            }
        );

        view()->composer(
            'admin.roles.*',
            function ($view) {
                $view->with('access_levels', AccessLevel::pluck('name', 'id')->toArray());

                $view->atributos = [];
                foreach (AccessLevel::pluck('name', 'id') as $key => $item) {
                    $view->atributos[$key] = ['title' => $item];
                }
            }
        );

        view()->composer(
            '*',
            function ($view) {
                $view->with('menus_system', Menu::whereNull('menu_id')->with('subMenus', 'modules')->get());
            }
        );
    }
}
