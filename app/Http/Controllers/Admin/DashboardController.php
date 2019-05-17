<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\{
    UsuarioService,
    RoleService,
    PermissionService
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
     *  Carrega as instâncias das dependências desta classe.
     */
    public function __construct(
        UsuarioService $usuario,
        RoleService $role,
        PermissionService $permission
    ) {
        $this->usuario = $usuario;
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Carrega a página inicial do dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = new \stdClass;
        $report->users = $this->usuario->countUser();
        $report->roles = $this->role->countRole();
        $report->permissions = $this->permission->countPermission();

        return view('admin.dashboard.index', compact('report'));
    }
}
