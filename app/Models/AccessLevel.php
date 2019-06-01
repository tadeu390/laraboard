<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessLevel extends Model
{
    use SoftDeletes;

    /**
     * Table associated with this model
     *
     * @var array
     */
    protected $table = 'access_levels';

    /**
     * Date type attributes
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Relationship
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'accesses');
    }

    /**
     * Relationship
     */
    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'accesses');
    }
}
