<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'label',
    ];

    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'accesses')
                ->using(\App\Models\Access::class)
                ->withPivot('id', 'module_id', 'access_level_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(\App\Models\User::class);
    }

    public function access_levels()
    {
        return $this->belongsToMany(\App\Models\AccessLevel::class, 'accesses')->withPivot('module_id', 'permission_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
