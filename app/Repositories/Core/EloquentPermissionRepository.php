<?php
namespace App\Repositories\Core;

use App\Repositories\Core\BaseEloquent\BaseEloquentRepository;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Models\Permission;

class EloquentPermissionRepository extends BaseEloquentRepository implements PermissionRepositoryInterface
{
    public function entity()
    {
        return Permission::class;
    }
}
