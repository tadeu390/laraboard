<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Response;
use App\Services\ModuleService;

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
        $reponse = "Você não tem permissão para realizar esta ação.";
        if (Gate::allows('CREATE', self::NICKNAME)) {
            $reponse = view('admin.menus._partials.form')->render();
        }

        return Response::json(array(
            'success' => true,
            'content'   => $reponse,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reponse = "Você não tem permissão para realizar esta ação.";
        if (Gate::allows('CREATE', self::NICKNAME)) {
            $service = $this->menu->store($request->all());
            $reponse = "ok";
        }

        return Response::json(array(
            'success' => true,
            'content' => $reponse,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reponse = "Você não tem permissão para realizar esta ação.";
        if (Gate::allows('UPDATE', self::NICKNAME)) {
            $menu = $this->menu->edit($id);
            $reponse = view('admin.menus._partials.form', compact('menu'))->render();
        }

        return Response::json(array(
            'success' => true,
            'content'   => $reponse,
        ));
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
        $reponse = "Você não tem permissão para realizar esta ação.";
        if (Gate::allows('UPDATE', self::NICKNAME)) {
            $service = $this->menu->update($id, $request->all());
            $reponse = "ok";
        }

        return Response::json(array(
            'success' => true,
            'content'   => $reponse,
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reponse = "Você não tem permissão para realizar esta ação.";
        if (Gate::allows('DELETE', self::NICKNAME)) {
            $service = $this->menu->delete($id);
            $reponse = "Ok";
        }

        return Response::json(array(
            'success' => true,
            'content' => $reponse,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $menu_id -> Menu que receberá um novo sub menu.
     * @return \Illuminate\Http\Response
     */
    public function createSubmenu($menu_id)
    {
        $reponse = "Você não tem permissão para realizar esta ação.";
        if (Gate::allows('CREATE', self::NICKNAME)) {
            $menus = $this->menu->combo();
            $reponse = view('admin.menus._partials.formSubmenu', ['menus' => $menus, 'menu_id' => $menu_id])->render();
        }

        return Response::json(array(
            'success' => true,
            'content'   => $reponse,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $sub_menu_id
     * @return \Illuminate\Http\Response
     */
    public function editSubmenu($sub_menu_id)
    {
        $reponse = "Você não tem permissão para realizar esta ação.";
        if (Gate::allows('UPDATE', self::NICKNAME)) {
            $menus = $this->menu->combo();
            $submenu = $this->menu->edit($sub_menu_id);
            $reponse = view('admin.menus._partials.formSubmenu', ['menus' => $menus, 'menu' => $submenu, 'menu_id' => $submenu->menu->id])->render();
        }

        return Response::json(array(
            'success' => true,
            'content'   => $reponse,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $menu_id
     * @return \Illuminate\Http\Response
     */
    public function addModule($menu_id, ModuleService $module)
    {
        $reponse = "Você não tem permissão para realizar esta ação.";
        if (Gate::allows('CREATE', self::NICKNAME)) {
            $modules = $module->getAll();
            $menus = $this->menu->combo();
            $reponse = view('admin.menus._partials.addModules', [ 'menus' => $menus, 'modules' => $modules, 'menu_id' => $menu_id])->render();
        }

        return Response::json(array(
            'success' => true,
            'content'   => $reponse,
        ));
    }
}
