<?php
namespace App\Repositories\Core;

use App\Repositories\Core\BaseEloquent\BaseEloquentRepository;
use App\Repositories\Contracts\MenuRepositoryInterface;
use App\Models\Menu;

class EloquentMenuRepository extends BaseEloquentRepository implements MenuRepositoryInterface
{
    public function entity()
    {
        return Menu::class;
    }
}
