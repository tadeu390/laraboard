<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Services\{
    RoleService,
    PermissionService,
    ModuleService
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    private $role;

    /**
     * @var PermissionService
     */
    private $permission;

    /**
     * @var ModuleService
     */
    private $module;

    private CONST NICKNAME = 'roles';

    /**
     *  Carrega as instâncias das dependências desta classe.
     */
    public function __construct(RoleService $role, PermissionService $permission, ModuleService $module)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->module = $module;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->hasPermission('READ', self::NICKNAME)) {
            $this->denied();
        }

        $roles = $this->role->index();
        $breadcrumb = $this->breadcrumb(['Funções']);

        return view('admin.roles.index', compact('roles', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasPermission('CREATE', self::NICKNAME)) {
            $this->denied();
        }

        $breadcrumb = $this->breadcrumb(['Funções', 'Novo']);

        return view('admin.roles.create', compact('breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        if (!auth()->user()->hasPermission('CREATE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->role->store($request->all());

        if (!$service->success) {
            return redirect()->route('roles.create')
                ->with('error', [
                    'class' => $service->class,
                    'message' => $service->message
                ])
                ->withInput();
        }

        return redirect()
                        ->route('roles.index')
                        ->withSuccess($service->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->hasPermission('READ', self::NICKNAME)) {
            $this->denied();
        }

        $role = $this->role->show($id);
        $breadcrumb = $this->breadcrumb(['Funções', 'Visualizar']);

        return view('admin.roles.show', compact('role', 'breadcrumb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->hasPermission('UPDATE', self::NICKNAME)) {
            $this->denied();
        }

        $role = $this->role->edit($id);
        $breadcrumb = $this->breadcrumb(['Funções', 'Editar', $role->name]);

        return view('admin.roles.edit', compact('breadcrumb', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\RoleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        if (!auth()->user()->hasPermission('UPDATE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->role->update($id, $request->all());

        if (!$service->success) {
            return redirect()->route('roles.edit', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route("roles.index")
                        ->withSuccess($service->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasPermission('DELETE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->role->delete($id);

        if (!$service->success) {
            return redirect()->route('roles.show', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route('roles.index')
                        ->withSuccess($service->message);
    }

    /**
     * Exibe o formulário de permissões da função.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPermissions(int $id)
    {
        $role = $this->role->edit($id);
        $permissions = $this->permission->getAll();
        $modules = $this->module->getAll();
        $breadcrumb = $this->breadcrumb(['Funções', 'Editar Permissões']);

        return view('admin.roles.showPermissions', compact('breadcrumb', 'role', 'permissions', 'modules'));
    }

    /**
     * Altera as permissões da função.
     *
     * @param  \Illuminate\Http\Requests  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePermissions(Request $request, int $id)
    {
        $service = $this->role->updatePermissions($request->all(), $id);

        if (!$service->success) {
            return redirect()->route('roles.showPermissions', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route('roles.index')
                        ->withSuccess($service->message);
    }
}
