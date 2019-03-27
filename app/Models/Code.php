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
		return self::join('etudiants', 'codes.idetudiants', '=', 'etudiants.idetudiants')
                      ->where('code',$code)->first();
	}

    /**
     * Recupere les codes tenant compte de la section
     *
     * @param  $idSection identifiant de la section 
     * @return App\Models\Code
     */

    public static function getBySection($idsection,$where = null){
        // $sql = self::where('idsections',$idsection);
        $sql = self::join('etudiants','codes.idetudiants','=','etudiants.idetudiants')
                    ->join('auditoires','etudiants.idauditoires','=','auditoires.idauditoires')
                    ->where('auditoires.idsections',$idsection);
        if ($where !== null) {
            $sql->where(key($where),$where);
        }

        return $sql;

    }

    /**
     * Recupere les codes tenant compte de la section et la session
     *
     * @param  $idSection identifiant de la section 
     * @return App\Models\Code
     */

    public static function getBySectionAndSession($idsection,$idsession,$where = null){
        $sql = self::leftJoin('etudiants_succes', 'codes.idetudiants', '=', 'etudiants_succes.idetudiants')
                    ->join('etudiants','codes.idetudiants','=','etudiants.idetudiants')
                    ->join('auditoires','etudiants.idauditoires','=','auditoires.idauditoires')
                    ->where('codes.idsessions',$idsession)
                    ->where('auditoires.idsections',$idsection)
                    ->whereRaw('(etudiants_succes.idetudiants is NULL  OR etudiants_succes.idsessions >='.$idsession.')');


            // $sql = self::leftJoin('etudiants_succes', 'codes.idetudiants', '=', 'etudiants_succes.idetudiants')
            //             ->where('codes.idsections',$idsection)
            //             ->where('codes.idsessions',$idsession)
            //             ->whereRaw('(etudiants_succes.idetudiants is NULL  OR etudiants_succes.idsessions >='.$idsession.')');
        if ($where !== null) {
            $sql->where(key($where),$where);
        }

        return $sql;
    }


    /**
     * Recupere les codes tenant compte de la section, la session et l'auditoire
     *
     * @param  $idSection identifiant de la section 
     * @return App\Models\Code
     */

    public static function getBySectionSessionAndAuditoire($idsection,$idsession,$idauditoire,$where=null){

        $sql = self::getBySectionAndSession($idsection,$idsession)->where('auditoires.idauditoires',$idauditoire);
        // $sql = self::join('etudiants','codes.idetudiants','etudiants.idetudiants')
        //             ->join('auditoires','auditoires.idauditoires','etudiants.idauditoires')
        //             ->leftJoin('etudiants_succes', 'codes.idetudiants', '=', 'etudiants_succes.idetudiants')
        //             ->where('codes.idsessions',$idsession)
        //             ->where('auditoires.idsections',$idSection)
        //             ->where('auditoires.idauditoires',$idauditoire)
        //             ->whereRaw('(etudiants_succes.idetudiants is NULL  OR etudiants_succes.idsessions >='.$idsession.')');

        if ($where !== null) {
            foreach ($where as $key => $value) {
                $sql->where($key,$value);
            }
        }
        return $sql;

    }


}
