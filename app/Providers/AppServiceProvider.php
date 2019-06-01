<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Categoria;
use App\Models\AccessLevel;
use Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use App\Models\Menu;
use App\Models\Module;

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

        $this->listaAccessLevel();
        $this->mountMenu();
        $this->customStatementAccessBlade();
        $this->modulePath();
    }

    /**
     * Monta uma lista contendo todos os níveis de acesso disponívies.
     */
    public function listaAccessLevel()
    {
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
    }

    /**
     * Monta o array para o menu.
     */
    public function mountMenu()
    {
        view()->composer(
            '*',
            function ($view) {
                $view->with('menus_system', Menu::whereNull('menu_id')->with('subMenus', 'modules')->get());
            }
        );
    }

    /**
     * Cria diretiva de vericação personalizada para o blade.
     * O intuito deste método é criar diretivas para vericação de permissões do usuário
     * no sistema.
     */
    public function customStatementAccessBlade()
    {
        Blade::if('canPermission', function($permission, $module_name, $register = null) {
            return Gate::allows($permission, [$module_name, $register]);
        });
    }

    /**
     * Monta um array contendo em ordem hierárquica, o caminho para se encontrar o módulo que está exibido na tela.
     * Isso é necessário para saber qual menu e quais submenus devem ficar abertos para que o usuário possa ver o módulo
     * atual selecionado no menu.
     */
    public function modulePath()
    {
        $module = Module::where('url', $this->urlCurrentScreenModule())->with('menu')->get()->first();
        if ($module != null) {
            global $menus;
            $menus = [];
            function hierarquiaMenu($menu)
            {
                global $menus;
                array_push($menus, $menu->name);

                if ($menu->menu != null) {
                    hierarquiaMenu($menu->menu);
                }
            }
            hierarquiaMenu($module->menu);

            view()->composer(
                '*',
                function ($view) use($menus){
                    $view->with('module_path', $menus);
                }
            );
        }
    }

    /**
     * Retorna a url do módulo que se encontra na tela.
     */
    public function urlCurrentScreenModule()
    {
        $url = "";
        $class = "class=active";
        for ($i = 1; Request::segment($i) != null; $i++) {
            $url .= Request::segment($i);

            if (is_numeric(Request::segment(($i + 1)))) {
                break;
            }
            if (Request::segment(($i + 1)) != null) {
                $url .= '/';
            }
        }

        view()->composer(
            '*',
            function ($view) use($url){
                $view->with('url_browser', $url);
            }
        );

        return $url;
    }
}
