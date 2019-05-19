<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Services\{
    UsuarioService,
    RoleService
};
use Illuminate\Support\Facades\Gate;

class UsuarioController extends Controller
{
    /**
     * @var UsuarioService
     */
    protected $usuario;

    /**
     * @var RoleService
     */
    protected $role;

    private CONST NICKNAME = 'users';

    /**
     *  Carrega as instâncias das dependências desta classe.
     */
    public function __construct(UsuarioService $usuario, RoleService $role)
    {
        $this->usuario = $usuario;
        $this->role = $role;
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

        $breadcrumb = $this->breadcrumb(['Usuários']);
        $usuarios = $this->usuario->index();

        return view('admin.usuarios.index', compact('usuarios', 'breadcrumb'));
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

        $breadcrumb = $this->breadcrumb(['Usuários', 'Novo']);
        return view('admin.usuarios.create', compact('breadcrumb'));
    }

    /**
     * Envia os dados para registro.
     *
     * @param  \Illuminate\Http\Requests\UsuarioRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        if (!auth()->user()->hasPermission('CREATE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->usuario->store($request->all());

        if (!$service->success) {
            return redirect()->route('usuarios.create')
                ->with('error', [
                    'class' => $service->class,
                    'message' => $service->message
                ])
                ->withInput();
        }

        return redirect()
                        ->route('usuarios.index')
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

        $breadcrumb = $this->breadcrumb(['Usuários', 'Visualizar']);
        $usuario = $this->usuario->show($id);

        if(!$usuario)
            return redirect()->back();

        return view('admin.usuarios.show', compact('usuario', 'breadcrumb'));
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

        $breadcrumb = $this->breadcrumb(['Usuários', 'Editar']);
        $usuario = $this->usuario->edit($id);

        if (!$usuario) {
            return redirect()->back();
        }

        return view('admin.usuarios.edit', compact('usuario', 'breadcrumb'));
    }

    /**
     * Envia os dados para serem atualizados.
     *
     * @param  \Illuminate\Http\Request\UsuarioRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, $id)
    {
        if (!auth()->user()->hasPermission('UPDATE', self::NICKNAME)) {
            $this->denied();
        }

        $service = $this->usuario->update($id, $request->all());

        if (!$service->success) {
            return redirect()->route('usuarios.edit', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route("usuarios.index")
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

        $service = $this->usuario->delete($id);

        if (!$service->success) {
            return redirect()->route('usuarios.show', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route('usuarios.index')
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
        $usuarios = $this->usuario->search($request);

        $data = $request->except('_token');
        return view('admin.usuarios.index', compact('usuarios', 'data'));
    }

    /**
     * Exibe o formulário de funções do usuário.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRoles(int $id)
    {
        $usuario = $this->usuario->edit($id);
        $roles = $this->role->getAll();
        $breadcrumb = $this->breadcrumb(['Usuários', 'Editar funções']);

        return view('admin.usuarios.showRoles', compact('breadcrumb', 'usuario', 'roles'));
    }

    /**
     * Altera as funções do usuário.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRoles(Request $request, int $id)
    {
        $service = $this->usuario->updateRoles($request->all(), $id);

        if (!$service->success) {
            return redirect()->route('usuarios.showRoles', $id)
                    ->with('error', [
                        'class' => $service->class,
                        'message' => $service->message
                    ])
                    ->withInput();
        }

        return redirect()
                        ->route('usuarios.index')
                        ->withSuccess($service->message);
    }

    /**
     * Debug for ACL.
     */
    public function permissions()
    {
        echo'<b>Debug ACL</b><br /><br />';
        echo 'Usuário logado: <b>'.auth()->user()->name.'</b><br />';
        echo 'ID do Usuário logado: <b>'.auth()->user()->id.'</b><br />';
        echo 'E-mail do Usuário logado: <b>'.auth()->user()->email.'</b><br /><pre>';

        foreach (auth()->user()->roles as $role) {
            echo '<b>Funções deste usuário</b> <br />';
            print_r($role->toArray());
            foreach ($role->permissions as $permission) {
                echo "<br />Permissões da função: <b>{$role->name}</b> <br />";
                print_r($permission->toArray());
            }
            echo '<br /><br />';
        }
    }

    public function date()
    {
        $date = new \DateTime('2019-01-01');
        $date->add(new \DateInterval('P1Y1M'));
        $date->add(new \DateInterval('PT1H'));
        $date->sub(new \DateInterval('PT30M'));
        $date = $date->format('d \d\e F \d\e Y');//imprime por extenso a data escapand os caracteres
        $format = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::SHORT);

        //echo $format->format($date);

        echo'<pre>';
        var_dump($date);
    }

    public function php7p1()
    {
        function a(?int $x = null):?int
        {
            return $x;
        }

        echo a(null);

        $array = [1, 2, 3];
        [$x, $y, $z] = $array;

        var_dump($x, $y, $z);
    }
}
