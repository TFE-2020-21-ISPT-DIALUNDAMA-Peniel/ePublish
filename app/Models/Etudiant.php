<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
     /**
     * définit la clé primaire personalisée.
     *
     * @var array
     */
    protected $primaryKey = 'idetudiants';



    /**
    * recupere  les étudiants en tenant compte de la section et session 
    * l'étudiant qui ont reussi ne serons pas récupéré au session suivante 
    * @param $idsession identifiant de la Session 
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function getBySectionAndSession($idsection,$idsession){

        return self::leftJoin('etudiants_succes', 'etudiants.idetudiants', '=', 'etudiants_succes.idetudiants')
                        ->join('auditoires','etudiants.idauditoires','=','auditoires.idauditoires')
                    	->whereRaw('(etudiants_succes.idetudiants is NULL  OR etudiants_succes.idsessions >='.$idsession.')')
                    	->where([
                            ['auditoires.idsections','=',$idsection]
                        ]);
                    	

    }

    /**
    * recupere  les étudiants en tenant compte de la section et session 
    * l'étudiant qui ont reussi ne serons pas récupéré au session suivante 
    * @param $idsession identifiant de la Session 
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function getBySectionSessionAndAuditoire($idsection,$idsession,$idauditoire,$name=''){

        $sql =self::getBySectionAndSession($idsection,$idsession)->where('etudiants.idauditoires',$idauditoire);
        if ($name !== '') {
            $sql->where('nom','like',$name.'%')->orWhere('etudiants.matricule',$name);
        }

        return $sql;
                        

    }

    

    public static function getStudentAndCodeBySectionSectionAndAuditoire($idsection,$idsession,$idauditoire,$name=''){

        $code = Code::getBySectionSessionAndAuditoire($idsection,$idsession,$idauditoire)
                ->select(['codes.idcodes','codes.code','codes.idetudiants','codes.idsessions','codes.statut as code.statut','codes.active as code.active']);

        $sql = self::getBySectionSessionAndAuditoire($idsection,$idsession,$idauditoire,$name)
            ->leftJoinSub($code, 'code', function ($join) {
                        $join->on('etudiants.idetudiants', '=', 'code.idetudiants');
                    })  ;        
                      // ->where('codes.idsessions',$idsession);
        return $sql->where('auditoires.idsections',$idsection)->where('auditoires.idauditoires',$idauditoire);

    }



    // public static function getBySection($idsection){

    //   return self::join('auditoires','etudiants.idauditoires','auditoires.idauditoires')
    //             ->where('auditoires.idsections',$idsection);
                        
    // }
}
