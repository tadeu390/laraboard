<?php
namespace App\Repositories\Core;

use App\Repositories\Core\BaseEloquent\BaseEloquentRepository;
use App\Repositories\Contracts\AccessRepositoryInterface;
use App\Models\Access;

class EloquentAccessRepository extends BaseEloquentRepository implements AccessRepositoryInterface
{
    public function entity()
    {
        return Access::class;
    }
}
