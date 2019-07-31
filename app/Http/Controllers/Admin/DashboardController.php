<?php

namespace App\Http\Controllers\Admin;

use App\Services\{
    UsuarioService,
    RoleService,
    PermissionService,
    ModuleService,
    GroupService,
    MenuService
};

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * @var UsuarioService
     */
    private $usuario;

    /**
     * @var RoleService
     */
    private $role;

    /**
     * @var PermissionService
     */
    private $permission;

    /**
     * @var PermissionService
     */
    private $module;

    /**
     * @var PermissionService
     */
    private $group;

    /**
     * @var PermissionService
     */
    private $menu;

    /**
     *  Carrega as instâncias das dependências desta classe.
     */
    public function __construct(
        UsuarioService $usuario,
        RoleService $role,
        PermissionService $permission,
        ModuleService $module,
        GroupService $group,
        MenuService $menu
    ) {
        $this->usuario = $usuario;
        $this->role = $role;
        $this->permission = $permission;
        $this->module = $module;
        $this->group = $group;
        $this->menu = $menu;
    }

    /**
     * Carrega a página inicial do dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = new \stdClass;
        $report->users = $this->usuario->count();
        $report->roles = $this->role->count();
        $report->permissions = $this->permission->count();
        $report->modules = $this->module->count();
        $report->groups = $this->group->count();
        $report->menus = $this->menu->count();

        return view('admin.dashboard.index', compact('report'));
    }
}
