<?php
namespace App\Repositories\Core;

use App\Repositories\Core\BaseEloquent\BaseEloquentRepository;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Models\Role;

class EloquentRoleRepository extends BaseEloquentRepository implements RoleRepositoryInterface
{
    public function entity()
    {
        return Role::class;
    }
}
