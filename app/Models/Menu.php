<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    /**
     * Table associated with this model
     *
     * @var array
     */
    protected $table = 'menus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'icon'
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
    public function subMenus()
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Relationship
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Relationship
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
