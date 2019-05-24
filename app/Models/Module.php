<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'url', 'icon', 'nick_name',
    ];
}
