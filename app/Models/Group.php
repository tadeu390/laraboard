<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'description'];

    protected $table = 'groups';

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function hasAnyRoles($roles, $groups, $module_id, $registro)
    {
        foreach ($groups as $group) {
            foreach ($roles as $role) {
                if ($group->roles->contains('name', $role->name) && $role->pivot->access_level_id != User::DESATIVADO &&
                        $role->pivot->module_id == $module_id
                    ) {

                    if($role->pivot->access_level_id == User::NAO_DEFINIDO) {
                        return true;
                    }

                    if ($registro->user_id != 0) {
                        $sameGroup = new User();
                        $sameGroup = $sameGroup->sameGroup($registro);
                    }

                    if ($role->pivot->access_level_id == User::PROPRIETARIO && auth()->user()->id != $registro->user_id &&
                        $registro->user_id != 0
                    ) {
                        return false;
                    } else if ($role->pivot->access_level_id == User::GRUPO && $registro->user_id != 0 && !$sameGroup) {
                        return false;
                    }
                    return true;
                }
            }
        }
        return false;
    }
}
