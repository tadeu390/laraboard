<?php
namespace App\Repositories\Core;

use App\Repositories\Core\BaseEloquent\BaseEloquentRepository;
use App\Repositories\Contracts\GroupRepositoryInterface;
use App\Models\Group;

class EloquentGroupRepository extends BaseEloquentRepository implements GroupRepositoryInterface
{
    public function entity()
    {
        return Group::class;
    }
}
