<?php
namespace App\Repositories\Core;

use App\Models\Produto;
use App\Repositories\Core\BaseEloquent\BaseEloquentRepository;
use App\Repositories\Contracts\ProdutoRepositoryInterface;
use Illuminate\Http\Request;

class EloquentProdutoRepository extends BaseEloquentRepository implements ProdutoRepositoryInterface
{
    public function entity()
    {
        return Produto::class;
    }

    public function search(Request $request)
    {
        return $this->entity->where(function($query) use($request) {
            if ($request->name) {
                $query = $query->where('name', 'LIKE', "%{$request->name}%")
                        ->orWhere('description', 'LIKE', "%{$request->name}%");
            }

            if ($request->price) {
                $query = $query->where('price', $request->price);
            }

            if ($request->categoria_id) {
                $query = $query->where('categoria_id', $request->categoria_id);
            }
        })->paginate(2);
    }
}
