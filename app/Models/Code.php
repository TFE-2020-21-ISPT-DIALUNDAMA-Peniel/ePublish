<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
     /**
     * Recupere les informations dans la code en joiture avec la table etudiant
     *
     * @param  $code  code
     * @return App\Models\Code
     */
	public static function getStudentAndCode($code){
		return self::join('etudiants', 'codes.matricule_etudiant', '=', 'etudiants.matricule')
                      ->where('code',$code)->first();
	}


}
