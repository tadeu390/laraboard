<?php
namespace App\Services;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Contracts\AccessRepositoryInterface;

class RoleService
{
    /**
     * @var RoleRepositoryInterface
     */
    private $repository;

    /**
     * @var PermissionRepositoryInterface
     */
    private $permission_repo;

    /**
     * @var AccessRepositoryInterface
     */
    private $access_repo;

    /**
     * Carrega as instâncias das dependências desta classe.
     */
    public function __construct(
        RoleRepositoryInterface $repository,
        PermissionRepositoryInterface $permission_repo,
        AccessRepositoryInterface $access_repo
    ) {
        $this->repository = $repository;
        $this->permission_repo = $permission_repo;
        $this->access_repo = $access_repo;
    }

    /**
     * Retorna uma lista contendo todas as funções.
     *
     * @return object mixed
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Retorna os dados do registro
     *
     * @return object mixed
     */
    public function index()
    {
        return $this->repository->paginate(30);
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
                'message' => 'Função cadastrada com sucesso.'
            ];
        } catch (\Exception $e) {
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
            $this->repository->update($id, $data);

            return (object) [
                'success' => true,
                'message' => 'Função atualizada com sucesso.'
            ];
        } catch (\Exception $e) {
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
            $this->repository->delete($id);

            return (object) [
                'success' => true,
                'message' => 'Função apagada com sucesso.'
            ];

        } catch (\Exception $e) {
            return (object) [
                'success' => false,
                'message' => $e->getMessage(),
                'class' => get_class($e)
            ];
        }
    }

    /**
     * Retorna a quantidade de funções.
     *
     * @return int
     */
    public function countRole()
    {
        return count($this->repository->getAll());
    }

    /**
     * Atualiza as permissões de uma função.
     *
     * @param array $data
     * @param int $id
     */
    public function updatePermissions($data, $id)
    {
        try {
            $role = $this->repository->findById($id);

            $permissions = $this->permission_repo->getAll();
            $key = 50;//qualquer valor, apenas para o array possuir uma chave
            $accesses = [];
            for ($i = 1; isset($data['module'.$i]); $i++) {
                $module_id = $data['module'.$i];

                foreach ($permissions as $permission) {
                    $relations = [];
                    $access_level_id = $data['module'.$i.'_'.$permission->name];
                    $relations[$key] = ['role_id' => $id, 'permission_id' => $permission->id, 'module_id' => $module_id, 'access_level_id' => $access_level_id];
                    $accesses = array_merge($accesses, $relations);
                }
            }

            $permissions = $role->permissions;
            for ($i = 0; $i < count($accesses); $i++) {
                if (isset($permissions[$i])) {
                    $this->access_repo->update($permissions[$i]->pivot->id, $accesses[$i]);
                } else {
                    $this->access_repo->store($accesses[$i]);
                }
            }

            return (object) [
                'success' => true,
                'message' => 'Permissões alteradas com sucesso.'
            ];

        } catch (\Exception $e) {
            return (object) [
                'success' => false,
                'message' => $e->getMessage(),
                'class' => get_class($e)
            ];
        }
    }
}
