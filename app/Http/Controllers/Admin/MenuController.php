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
     * @param int $menu_id
     * @return \Illuminate\Http\Response
     */
    public function create($menu_id)
    {
        $reponse = "Você não tem permissão para realizar esta ação.";
        $success = false;
        if (Gate::allows('CREATE', self::NICKNAME)) {
            $menus = $this->menu->combo();
            $reponse = view('admin.menus._partials.form', ['menus' => $menus, 'menu_id' => $menu_id])->render();
            $success = true;
        }

        return Response::json(array(
            'success' => $success,
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
        $success = false;
        if (Gate::allows('CREATE', self::NICKNAME)) {
            $service = $this->menu->store($request->all());
            $reponse = "ok";
            $success = true;
        }

        return Response::json(array(
            'success' => $success,
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
        $success = false;
        if (Gate::allows('UPDATE', self::NICKNAME)) {
            $menu = $this->menu->edit($id);
            $menus = $this->menu->combo($id);
            $menu_id = null;
            if ($menu->menu != null) {
                $menu_id = $menu->menu->id;
            }
            $reponse = view('admin.menus._partials.form', compact('menu', 'menus', 'menu_id'))->render();
            $success = true;
        }

        return Response::json(array(
            'success' => $success,
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
    public function update(Request $request, $id)
    {
        $reponse = "Você não tem permissão para realizar esta ação.";
        $success = false;
        if (Gate::allows('UPDATE', self::NICKNAME)) {
            $service = $this->menu->update($id, $request->all());
            $reponse = "ok";
            $success = true;
        }

        return Response::json(array(
            'success' => $success,
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
        $response = "Você não tem permissão para realizar esta ação.";
        $success = false;
        if (Gate::allows('DELETE', self::NICKNAME)) {
            $service = $this->menu->delete($id);
            $response = "ok";
            $success = true;
        }

        return Response::json(array(
            'success' => $success,
            'content' => $response,
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
        $success = false;
        if (Gate::allows('CREATE', self::NICKNAME)) {
            $modules = $module->getAll();
            $menus = $this->menu->combo();
            $reponse = view('admin.menus._partials.addModules', [ 'menus' => $menus, 'modules' => $modules, 'menu_id' => $menu_id])->render();
            $success = true;
        }

        return Response::json(array(
            'success' => $success,
            'content'   => $reponse,
        ));
    }

    /**
     * Save modules selecteds.
     *
     * @param  \Illuminate\Http\Requests $request
     * @return \Illuminate\Http\Response
     */
    public function saveModules(Request $request)
    {
        $response = "";
        $result = $this->menu->saveModules($request);

        if (!$result->success) {
            $response = "Ocorreu um erro ao processar sua requisição.";
        }

        return Response::json(array(
            'success' => $result->success,
            'content'   => $response,
        ));
    }

    /**
     * Remove module from menu.
     *
     * @param int $module_id
     * @return \Illuminate\Http\Response
     */
    public function removeModule($module_id)
    {
        $response = "";
        $result = $this->menu->removeModule($module_id);

        if (!$result->success) {
            $response = "Ocorreu um erro ao processar sua requisição.";
        }

        return Response::json(array(
            'success' => $result->success,
            'content'   => $response,
        ));
    }

    /**
     * Load form to move module.
     *
     * @param  int $module_id
     * @return \Illuminate\Http\Response
     */
    public function moveModule($module_id, ModuleService $module)
    {
        $reponse = "Você não tem permissão para realizar esta ação.";
        $success = false;
        if (Gate::allows('CREATE', self::NICKNAME)) {
            $module = $module->show($module_id);
            $menus = $this->menu->combo(-1);
            $reponse = view('admin.menus._partials.moveModule', [ 'menus' => $menus, 'module' => $module, 'menu_id' => $module->menu_id])->render();
            $success = true;
        }

        return Response::json(array(
            'success' => $success,
            'content'   => $reponse,
        ));
    }

    /**
     * Move module for other menu.
     *
     * @param  \Illuminate\Http\Requests $request
     * @return \Illuminate\Http\Response
     */
    public function saveMoveModule(Request $request)
    {
        $response = "";
        $result = $this->menu->saveMoveModule($request);

        if (!$result->success) {
            $response = "Ocorreu um erro ao processar sua requisição.";
        }

        return Response::json(array(
            'success' => $result->success,
            'content'   => $response,
        ));
    }
}
