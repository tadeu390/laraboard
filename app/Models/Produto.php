<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'name',
        'url',
        'description',
        'price',
        'categoria_id',
        'user_id',
    ];

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
