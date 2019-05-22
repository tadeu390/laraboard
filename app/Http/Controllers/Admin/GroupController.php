<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\{
    GroupService,
    RoleService
};
use App\Http\Requests\GroupRequest;
use Illuminate\Support\Facades\Gate;

class GroupController extends Controller
{
    /**
     * @var GroupService
     */
    protected $group;

    /**
     * @var RoleService
     */
    protected $role;

    private CONST NICKNAME = 'groups';

    /**
     *  Carrega as instâncias das dependências desta classe.
     */
    public function __construct(GroupService $group, RoleService $role)
    {
        $this->group = $group;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('READ', self::NICKNAME)) {
            $this->denied();
        }

        $breadcrumb = $this->breadcrumb(['Grupos']);
        $groups = $this->group->index();

        return view('admin.groups.index', compact('groups', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('CREATE', self::NICKNAME)) {
            $this->denied();
        }

        $breadcrumb = $this->breadcrumb(['Grupos', 'Novo']);
        return view('admin.groups.create', compact('breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\GroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        if (Gate::denies('CREATE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->group->store($request->all());

        if (!$service->success) {
            return redirect()->route('groups.create')
                ->with('error', [
                    'class' => $service->class,
                    'message' => $service->message
                ])
                ->withInput();
        }

        return redirect()
                        ->route('groups.index')
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
        if (Gate::denies('READ', self::NICKNAME)) {
            $this->denied();
        }

        $breadcrumb = $this->breadcrumb(['Grupos', 'Visualizar']);
        $group = $this->group->show($id);

        if(!$group)
            return redirect()->back();

        return view('admin.groups.show', compact('group', 'breadcrumb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('UPDATE', self::NICKNAME)) {
            $this->denied();
        }

        $breadcrumb = $this->breadcrumb(['Grupos', 'Editar']);
        $group = $this->group->edit($id);

        if (!$group) {
            return redirect()->back();
        }

        return view('admin.groups.edit', compact('group', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\GroupRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, $id)
    {
        if (Gate::denies('UPDATE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->group->update($id, $request->all());

        if (!$service->success) {
            return redirect()->route('groups.edit', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route("groups.index")
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
        if (Gate::denies('DELETE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->group->delete($id);

        if (!$service->success) {
            return redirect()->route('groups.show', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route('groups.index')
                        ->withSuccess($service->message);
    }

    /**
     * Exibe o formulário de funções do grupo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRoles(int $id)
    {
        $group = $this->group->edit($id);
        $roles = $this->role->getAll();
        $breadcrumb = $this->breadcrumb(['Grupos', 'Editar funções']);

        return view('admin.groups.showRoles', compact('breadcrumb', 'group', 'roles'));
    }

    /**
     * Altera as funções do grupo.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRoles(Request $request, int $id)
    {
        $service = $this->group->updateRoles($request->all(), $id);

        if (!$service->success) {
            return redirect()->route('groups.showRoles', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route('groups.index')
                        ->withSuccess($service->message);
    }
}
