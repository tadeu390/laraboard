<?php
namespace App\Services;

use App\Repositories\Contracts\MenuRepositoryInterface;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use App\Repositories\Contracts\ModuleRepositoryInterface;

class MenuService
{
    /**
     * @var MenuRepositoryInterface
     */
    protected $repository;

    /**
     * @var ModuleRepositoryInterface
     */
    protected $module;

    /**
     * Carrega as instâncias das dependências desta classe.
     */
    public function __construct(MenuRepositoryInterface $repository, ModuleRepositoryInterface $module)
    {
        $this->repository = $repository;
        $this->module = $module;
    }

    /**
     * Retorna os dados do registro
     *
     * @return object mixed
     */
    public function index()
    {
        $menus = $this->repository
                ->findWhereNull('menu_id')
                ->relationShips('subMenus', 'modules')
                ->paginate(30);

        //gambi temporária
                foreach ($menus as $key => $item) {
            if ($item->menu_id != null) {
                unset($menus[$key]);
            }
        }
        return $menus;
    }

    /**
     * Retorna os dados de forma específica para o combo box de menu. Para o menu em questão,
     * ou seja, o menu da id informada no segundo parâmetro, não são mostrados os menus filhos.
     *
     */
    public function combo($id = null)
    {
        if ($id != -1) {
            $opcoes[''] = 'Selecione';
        }

        global $flag;
        $flag = false;

        function menuPai($menu, $id)
        {
            global $flag;
            if ($menu->menu_id == $id) {
                $flag = true;
            } else if ($menu->menu != null) {
                menuPai($menu->menu, $id);
            }
        }

        foreach ($this->repository->getAll() as $menu) {
            if ($id != null) {
                menuPai($menu, $id);
            }
            if (!$flag && $menu->id != $id) {
                $opcoes[$menu->id] = $menu->name;
            }
            $flag = false;
        }

        return (object) $opcoes;
    }

    /**
     * Retorna os dados do registro
     *
     * @param  integer $id
     * @return object mixed
     */
    public function show($id)
    {
        return $this->repository->findWhereFirst('id', $id);
    }

    /**
     * Envia os dados para o repositório registrar no banco.
     *
     * @param mixed $data
     * @return object mixed
     */
    public function store($data)
    {
        try {

            $this->repository->store($data);

            return (object) [
                'success' => true,
                'message' => 'Menu cadastrado com sucesso.'
            ];
        } catch(\Exception $e) {
            return (object) [
                'success' => false,
                'message' => $e->getMessage(),
                'class' => get_class($e)
            ];
        }
    }

    /**
     * Retorna os dados do registro
     *
     * @param  int $id
     * @return object mixed
     */
    public function edit($id)
    {
        return $this->repository->findById($id);
    }

    /**
     * Envia os dados para o repositório alterar no banco.
     *
     * @param mixed $data
     * @param int $id
     * @return object mixed
     */
    public function update($id, $data)
    {
        try {
            //throw new Exception("Error Processing Request", 1);
            $this->repository->update($id, $data);

            return (object) [
                'success' => true,
                'message' => 'Menu atualizado com sucesso.'
            ];
        } catch(\Exception $e) {
            return (object) [
                'success' => false,
                'message' => $e->getMessage(),
                'class' => get_class($e)
            ];
        }
    }

    /**
     * Faz com que o repositório exclua um determinado registro no banco de dados.
     *
     * @param int $id
     * @return object mixed
     */
    public function delete($id)
    {
        try {
            $menu = $this->repository->findById($id);
            if ($menu) {
                foreach ($menu->modules as $module) {
                    $module->menu_id = null;
                    $this->saveMoveModule($module);
                }
                $this->repository->delete($id);
            }
            return (object) [
                'success' => true,
                'message' => 'Menu apagado com sucesso.'
            ];

        } catch(\Exception $e) {
            return (object) [
                'success' => false,
                'message' => $e->getMessage(),
                'class' => get_class($e)
            ];
        }
    }

    /**
     * Solicita a repositório para que faça busca no banco de dados conforme os parâmetros de busca contidos
     * no objeto $request.
     *
     * @param  \Illuminate\Http\Requests $request
     * @return object mixed
     */
    public function search(Request $request)
    {
        return $this->repository->search($request);
    }

    /**
     * Retorna a quantidade de permissões.
     *
     * @return int
     */
    public function count()
    {
        return count($this->repository->getAll());
    }

    /**
     * Save modules in database.
     *
     * @param mixed $data
     * @return object mixed
     */
    public function saveModules($data)
    {
        foreach ($data->modules as $item) {
            try {
                $module = $this->module->findById($item);
                $module->menu_id = $data->menu_id;
                $this->module->update($module->id, $module->toArray());
            } catch(\Exception $e) {
                return (object) [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'class' => get_class($e)
                ];
            }
        }

        return (object) [
            'success' => true,
            'message' => 'Módulo(s) adicionado(s) com sucesso.'
        ];
    }

    /**
     * Remove module from menu.
     *
     * @param int $module_id
     * @return object mixed
     */
    public function removeModule($module_id)
    {
        try {
            $module = $this->module->findById($module_id);
            $module->menu_id = null;
            $this->module->update($module_id, $module->toArray());

            return (object) [
                'success' => true,
                'message' => 'Módulo removido com sucesso.'
            ];
        } catch(\Exception $e) {
            return (object) [
                'success' => false,
                'message' => $e->getMessage(),
                'class' => get_class($e)
            ];
        }
    }

    /**
     * Move module for other menu.
     *
     * @param mixed $data
     * @return object mixed
     */
    public function saveMoveModule($data)
    {
        try {
            $module = $this->module->findById($data->id);
            $module->menu_id = $data->menu_id;
            $this->module->update($data->id, $module->toArray());

            return (object) [
                'success' => true,
                'message' => 'Módulo movido com sucesso.'
            ];
        } catch(\Exception $e) {
            return (object) [
                'success' => false,
                'message' => $e->getMessage(),
                'class' => get_class($e)
            ];
        }
    }
}
