<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    /**
     * définit la clé primaire personalisée.
     *
     * @var array
     */
    protected $primaryKey = 'idcodes';
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

    /**
     * Recupere les codes tenant compte de la section
     *
     * @param  $idSection identifiant de la section 
     * @return App\Models\Code
     */

    public static function getBySection($idSection){
        return self::where('idsections',$idSection)->get();
    }


}
