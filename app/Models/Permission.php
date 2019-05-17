<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'label',
    ];

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'accesses')->withPivot('access_level_id', 'module_id');
    }

    public function access_levels()
    {
        return $this->belongsToMany(\App\Models\AccessLevel::class, 'accesses');
    }

    public function modules()
    {
        return $this->belongsToMany(\App\Models\Module::class, 'accesses')->withPivot('access_level_id', 'module_id');
    }
}
