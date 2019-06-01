<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Access extends Pivot
{
    /**
     * Table associated with this model
     *
     * @var array
     */
    protected $table = 'accesses';

    /**
     * Disabled timestamps
     */
    public $timestamps = false;
}
