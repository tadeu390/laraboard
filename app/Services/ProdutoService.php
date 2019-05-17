<?php
namespace App\Services;

use App\Repositories\Contracts\ProdutoRepositoryInterface;
use Illuminate\Http\Request;

class ProdutoService
{
    protected $repository;

    public function __construct(ProdutoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository
                    ->orderBy('id')
                    ->relationships('categoria')
                    ->paginate(3);
    }

    public function show($id)
    {
        return $this->repository->findWhereFirst('id', $id);
    }

    public function store($data)
    {
        return $this->repository->store($data);
    }

    public function edit($id)
    {
        return $this->repository->findById($id);
    }

    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function search(Request $request)
    {
        return $this->repository->search($request);
    }
}
