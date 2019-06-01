<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    /**
     * Table associated with this model
     *
     * @var array
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
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
        return $this->belongsToMany(Role::class);
    }

    /**
     * Relationship
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Verifica se algum grupo da lista possui alguma função associada a si. Os grupos em questão são todos
     * aqueles que um usuário faz parte. Obs.: as funções são obtidas na model de usuário com base na permissão informada.
     *
     * @param mixed $roles -> Funções associadas a uma determinada permissão que se deseja verificar.
     * @param mixed $groups -> Grupos associados ao usuário logado.
     * @param int $module_id -> Módulo que se deseja verificar a permissão.
     * @param mixed $registro -> Registro que se deseja verificar se o usuário logado tem uma determinada permissão.
     * @return bool
     */
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
