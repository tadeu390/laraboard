<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    /**
     * Table associated with this model
     *
     * @var array
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'label',
    ];

    /**
     * Date type attributes
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Relationship
     */
    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'accesses')
                ->using(\App\Models\Access::class)
                ->withPivot('id', 'module_id', 'access_level_id');
    }

    /**
     * Relationship
     */
    public function usuarios()
    {
        return $this->belongsToMany(\App\Models\User::class);
    }

    /**
     * Relationship
     */
    public function access_levels()
    {
        return $this->belongsToMany(\App\Models\AccessLevel::class, 'accesses')->withPivot('module_id', 'permission_id');
    }

    /**
     * Relationship
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
