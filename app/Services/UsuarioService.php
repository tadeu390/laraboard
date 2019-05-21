<?php
namespace App\Services;

use App\Repositories\Contracts\UsuarioRepositoryInterface;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;

class UsuarioService
{
    /**
     * @var UsuarioRepositoryInterface
     */
    protected $repository;

    /**
     * Carrega as instâncias das dependências desta classe.
     */
    public function __construct(UsuarioRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
                'message' => 'Usuário cadastrado com sucesso.'
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
                'message' => 'Usuário atualizado com sucesso.'
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
            $this->repository->delete($id);

            return (object) [
                'success' => true,
                'message' => 'Usuário apagado com sucesso.'
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
     * Retorna a quantidade de usuários.
     *
     * @return int
     */
    public function countUser()
    {
        return count($this->repository->getAll());
    }

    /**
     * Atualiza as funções de um usuário.
     *
     * @param array $data
     * @param int $id
     */
    public function updateRoles($data, $id)
    {
        try {
            $user = $this->repository->findById($id);

            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
            } else {
                $user->roles()->detach();
            }

            return (object) [
                'success' => true,
                'message' => 'Funções alteradas com sucesso.'
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
     * Atualiza as funções de um usuário.
     *
     * @param array $data
     * @param int $id
     */
    public function updateGroups($data, $id)
    {
        try {
            $user = $this->repository->findById($id);

            if (isset($data['groups'])) {
                $user->groups()->sync($data['groups']);
            } else {
                $user->groups()->detach();
            }

            return (object) [
                'success' => true,
                'message' => 'Grupos alterados com sucesso.'
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
