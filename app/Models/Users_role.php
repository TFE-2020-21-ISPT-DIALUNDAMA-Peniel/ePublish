<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users_role extends Model
{

        /**
     * définit la clé primaire personalisée.
     *
     * @var array
     */
    protected $primaryKey = 'idusers_roles';
     /**
     * Récupere le role de l'utilsateur
     * @param $id
     * @return string
     */
    public static function getUserRole($userIdusers_roles)
    {	
    	if (is_integer($userIdusers_roles)) {
       	 	return $field = self::where('idusers_roles',$userIdusers_roles)->first()->lib;
    	}
    }

}
