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
    protected $primaryKey = 'matricule';



    /**
    * recupere  les étudiants en tenant compte de la section et session 
    * l'étudiant qui ont reussi ne serons pas récupéré au session suivante 
    * @param $idsession identifiant de la Session 
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function getStudentsBySectionAndSession($idsession,$idsection){

        return Etudiant::leftJoin('etudiants_succes', 'etudiants.matricule', '=', 'etudiants_succes.matricule_etudiant')
                    	->whereRaw('(etudiants_succes.matricule_etudiant is NULL  OR etudiants_succes.idsessions >='.$idsession.')')
                    	->where([
                            ['etudiants.idsections','=',e($idsection)]
                        ])
                        ->orderBy("idpromotions")->get();
                    	

    }
}
