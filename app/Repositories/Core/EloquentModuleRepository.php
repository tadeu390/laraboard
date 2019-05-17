<?php
namespace App\Repositories\Core;

use App\Models\Module;
use App\Repositories\Core\BaseEloquent\BaseEloquentRepository;
use App\Repositories\Contracts\ModuleRepositoryInterface;
use Illuminate\Http\Request;

class EloquentModuleRepository extends BaseEloquentRepository implements ModuleRepositoryInterface
{
    public function entity()
    {
        return Module::class;
    }

    public function search(Request $request)
    {
        return $this->entity->where(function($query) use($request) {
            if ($request->name) {
                $query = $query->where('name', 'LIKE', "%{$request->name}%");
            }
        })->paginate(2);
    }
}
