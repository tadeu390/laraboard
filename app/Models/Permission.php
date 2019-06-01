<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    /**
     * Table associated with this model
     *
     * @var array
     */
    protected $table = 'permissions';

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
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'accesses')->withPivot('access_level_id', 'module_id');
    }

    /**
     * Relationship
     */
    public function access_levels()
    {
        return $this->belongsToMany(\App\Models\AccessLevel::class, 'accesses');
    }

    /**
     * Relationship
     */
    public function modules()
    {
        return $this->belongsToMany(\App\Models\Module::class, 'accesses')->withPivot('access_level_id', 'module_id');
    }
}
