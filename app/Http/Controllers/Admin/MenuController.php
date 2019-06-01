<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenuController extends Controller
{
    /**
     * @var MenuService
     */
    private $menu;

    private CONST NICKNAME = 'menus';

    /**
     *  Carrega as instâncias das dependências desta classe.
     */
    public function __construct(MenuService $menu)
    {
        $this->menu = $menu;
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

        $menus = $this->menu->index();

        $breadcrumb = $this->breadcrumb(['Menus']);

        return view('admin.menus.index', compact('menus', 'breadcrumb'));
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

        $breadcrumb = $this->breadcrumb(['Menus', 'Novo']);

        return view('admin.menus.create', compact('breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        if (Gate::denies('CREAte', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->menu->store($request->all());

        if (!$service->success) {
            return redirect()->route('menus.create')
                ->with('error', [
                    'class' => $service->class,
                    'message' => $service->message
                ])
                ->withInput();
        }

        return redirect()
                        ->route('menus.index')
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

        $menu = $this->menu->show($id);
        $breadcrumb = $this->breadcrumb(['Menus', 'Visualizar']);

        return view('admin.menus.show', compact('menu', 'breadcrumb'));
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

        $menu = $this->menu->edit($id);
        $breadcrumb = $this->breadcrumb(['Menus', 'Editar', $menu->name]);

        return view('admin.menus.edit', compact('breadcrumb', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\RoleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        if (Gate::denies('UPDATE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->menu->update($id, $request->all());

        if (!$service->success) {
            return redirect()->route('menus.edit', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route("menus.index")
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

        $service = $this->menu->delete($id);

        if (!$service->success) {
            return redirect()->route('menus.show', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route('menus.index')
                        ->withSuccess($service->message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSubMenu()
    {
        if (Gate::denies('CREATE', self::NICKNAME)) {
            $this->denied();
        }

        $breadcrumb = $this->breadcrumb(['Menus', 'Novo Sub Menu']);

        return view('admin.menus.submenus.create', compact('breadcrumb'));
    }
}
