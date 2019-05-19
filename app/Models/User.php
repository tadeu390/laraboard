<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Permission;

class User extends Authenticatable
{
    CONST PROPRIETARIO = 4;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class);
    }

    /**
     * Recebe uma permissão para verificar se o usuário logado a possui.
     *
     * @param Permission $permission
     * @return bool
     */
    public function hasPermission(String $permission, String $moduleName, object $registro = null)
    {
        $module = Module::where('nickname', $moduleName)->get()->first();

        if (!$module) {
            return false;
        }

        $permission = Permission::where('name', $permission)->get()->first();
        if (!$permission) {
            return false;
        }

        if ($registro == null || !is_object($registro)) {
            $registro = new \stdClass;
            $registro->user_id = 0;
        } else {
            $registro = (object) $registro->toArray();
        }
        $permission = $this->hasAnyRoles($permission->roles, $module->id, $registro);

        if ($permission) {
            return $permission;
        } else {
            return false;
            //chamar HasPermission de group model para verificar se o usuário possui permissão do seu grupo em alguma funcao 
            //atrelada ao grupo dele
        }
    }

    /**
     * Verifica se o usuário logado tem as funções passadas por parâmetro associadas a si.
     * Para isso é necessário buscar todas as funções associadas ao usuário logado.
     *
     * @param array $roles -> Contém todas as funções associada a uma permissão específica
     * @return bool
     */
    public function hasAnyRoles($roles, $module_id, $registro)
    {
        /**
         * Abaixo buscamos todas as funções associadas ao usuário logado, em seguida retonará true ou false
         *  caso uma função de uma determinada permissão esteja associada ao usuário.
         */

        if (is_array($roles) || is_object($roles)) {
            foreach ($roles as $role) {
                 if ($this->roles->contains('name', $role->name) && $role->pivot->access_level_id != 1 && $role->pivot->module_id == $module_id) {
                    if ($role->pivot->access_level_id == User::PROPRIETARIO && auth()->user()->id != $registro->user_id && $registro->user_id != 0) {
                        return false;
                    }
                    return true;
                 }
            }
            return false;
        }

        //Quando passar o nome da função direito sem ser um array. Ou seja, uma única função a se verificar.
        return $this->roles->contains('name', $roles);
    }
}
