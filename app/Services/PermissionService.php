<?php
namespace App\Services;

use App\Repositories\Contracts\PermissionRepositoryInterface;

class PermissionService
{
    /**
     * @var PermissionRepositoryInterface
     */
    private $repository;

    /**
     * Carrega as instâncias das dependências desta classe.
     */
    public function __construct(PermissionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retorna uma lista contendo todas as permissões
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
                'message' => 'Permissão cadastrada com sucesso.'
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
                'message' => 'Permissão atualizada com sucesso.'
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
                'message' => 'Permissão apagada com sucesso.'
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
     * Retorna a quantidade de permissões.
     *
     * @return int
     */
    public function countPermission()
    {
        return count($this->repository->getAll());
    }

    /**
     * Desvincula uma função de uma permissão.
     *
     * @param int $permission_id
     * @param int $role_id
     * @return object mixed
     */
    public function removeFuncao($permission_id, $role_id)
    {
        try {
            $permission = $this->repository->findById($permission_id);
            $permission->roles()->detach($role_id);

            return (object) [
                'success' => true,
                'message' => 'Função desvinculada com sucesso.'
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
