<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    /**
     * Table associated with this model
     *
     * @var array
     */
    protected $table = 'modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'url', 'icon', 'nick_name',
    ];

    /**
     * Date type attributes
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
