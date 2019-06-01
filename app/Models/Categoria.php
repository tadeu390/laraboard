<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'url',
        'description'
    ];

    protected $dates = ['deleted_at'];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
