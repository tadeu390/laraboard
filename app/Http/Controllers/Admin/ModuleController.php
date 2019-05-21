<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Services\ModuleService;

class ModuleController extends Controller
{
    /**
     * @var ModuleService
     */
    protected $module;

    /**
     * Identificador do módulo
     */
    private CONST NICKNAME = 'modules';

    /**
     *  Carrega as instâncias das dependências desta classe.
     */
    public function __construct(ModuleService $module)
    {
        $this->module = $module;
    }

    /**
     * Mostra a lista de registros.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->hasPermission('READ', self::NICKNAME)) {
            $this->denied();
        }

        $breadcrumb = $this->breadcrumb(['Módulos']);
        $modules = $this->module->index();

        return view('admin.modules.index', compact('modules', 'breadcrumb'));
    }

    /**
     * Mostra o formulário para criar um novo registro.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasPermission('CREATE', self::NICKNAME)) {
            $this->denied();
        }

        $breadcrumb = $this->breadcrumb(['Módulos', 'Novo']);
        return view('admin.modules.create', compact('breadcrumb'));
    }

    /**
     * Envia os dados para registro.
     *
     * @param  \Illuminate\Http\Requests\ModuleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleRequest $request)
    {
        if (!auth()->user()->hasPermission('CREATE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->module->store($request->all());

        if (!$service->success) {
            return redirect()->route('modules.create')
                ->with('error', [
                    'class' => $service->class,
                    'message' => $service->message
                ])
                ->withInput();
        }

        return redirect()
                        ->route('modules.index')
                        ->withSuccess($service->message);
    }

    /**
     * Mostra um registro específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->hasPermission('READ', self::NICKNAME)) {
            $this->denied();
        }

        $breadcrumb = $this->breadcrumb(['Módulos', 'Visualizar']);
        $module = $this->module->show($id);

        if(!$module)
            return redirect()->back();

        return view('admin.modules.show', compact('module', 'breadcrumb'));
    }

    /**
     * Exibe um registro para edição.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->hasPermission('UPDATE', self::NICKNAME)) {
            $this->denied();
        }

        $breadcrumb = $this->breadcrumb(['Módulos', 'Editar']);
        $module = $this->module->edit($id);

        if (!$module) {
            return redirect()->back();
        }

        return view('admin.modules.edit', compact('module', 'breadcrumb'));
    }

    /**
     * Envia os dados para serem atualizados.
     *
     * @param  \Illuminate\Http\Request\ModuleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleRequest $request, $id)
    {
        if (!auth()->user()->hasPermission('UPDATE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->module->update($id, $request->all());

        if (!$service->success) {
            return redirect()->route('modules.edit', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route("modules.index")
                        ->withSuccess($service->message);
    }

    /**
     * Solicita a camada de serviço a remoção de um registro.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasPermission('DELETE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->module->delete($id);

        if (!$service->success) {
            return redirect()->route('modules.show', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route('modules.index')
                        ->withSuccess($service->message);
    }

    /**
     * Pega os dados de busca informados pelo usuário.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $modules = $this->module->search($request);

        $data = $request->except('_token');
        return view('admin.modules.index', compact('modules', 'data'));
    }
}
