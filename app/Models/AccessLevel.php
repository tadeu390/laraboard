<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    protected $table = 'access_levels';

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'accesses');
    }

    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'accesses');
    }
}
