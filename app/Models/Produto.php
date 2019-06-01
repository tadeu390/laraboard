<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'url',
        'description',
        'price',
        'categoria_id',
        'user_id',
    ];

    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderByPrice', function(Builder $builder) {
            $builder->orderBy('price', 'DESC');
        });
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
