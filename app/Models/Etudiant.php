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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'matricule','nom','postnom','prenom','idauditoires'
    ];

    /**
     * Evénement éloquent lors de la creation d'un étudiant
     * l'année academique en cours est recuperée automatique
     */
    protected static function boot(){
        parent::boot();

        static::creating(function($etudiant){
            $etudiant->annee_acad = Gestion_annee::getAnneeAcademiqueEnCours()->idgestion_annees;

        });
    }


    /**
    * recupere  les étudiants en tenant compte de la section et session 
    * l'étudiant qui ont reussi ne serons pas récupéré au session suivante 
    * @param $idsession identifiant de la Session 
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function getBySectionAndSession($idsection,$idsession){

        return self::EtudiantParSection($idsection)->EtudiantParSession($idsession);

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
            $sql->EtudiantSearch($name);
        }

        return $sql;
                        

    }

    /**
    * recupere  les étudiants et leurs codes en tenant compte de la section,session,auditoire 
    * l'étudiant qui ont reussi ne serons pas récupéré au session suivante 
    * @param $idsession identifiant de la Session 
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    * @param $idauditoire identifiant de l'auditoire  
    */    

    public static function getStudentAndCodeBySectionSectionAndAuditoire($idsection,$idsession,$idauditoire,$name=''){

        $code = Code::getBySectionSessionAndAuditoire($idsection,$idsession,$idauditoire)
                ->select(['codes.idcodes','codes.code','codes.idetudiants','codes.idsessions','codes.statut as code-statut','codes.active as code-active']);

        $sql = self::getBySectionSessionAndAuditoire($idsection,$idsession,$idauditoire,$name)
            ->leftJoinSub($code, 'code', function ($join) {
                        $join->on('etudiants.idetudiants', '=', 'code.idetudiants');
                    })  ;        
                      // ->where('codes.idsessions',$idsession);
        return $sql->where('auditoires.idsections',$idsection)->where('auditoires.idauditoires',$idauditoire);

    }




    /**********
    * SCOPES 
    **********/

    /**
    * joint Etudiant avec la table auditoire 
    */

    public static function scopeEtudiantJoinAuditoire($query){

        return $query->join('auditoires','etudiants.idauditoires','=','auditoires.idauditoires')
                        ;
                        

    }

    /**
    * recupere  les étudiants actifs
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function scopeEtudiantActif($query){

        return $query->where('etudiants.statut',true);
                        

    }

    /**
    * recupere  les étudiants en tenant compte de la section  
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function scopeEtudiantParSection($query,$idsection){

        return $query->EtudiantJoinAuditoire()
                    ->where('auditoires.idsections','=',$idsection);
                        

    }

    /**
    * recupere  les étudiants en tenant compte de l'auditoire'
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function scopeEtudiantParAuditoire($query,$idauditoires){

        return $query->where('etudiants.idauditoires','=',$idauditoires);
                        

    }

    /**
    * recupere  les étudiants en tenant compte de la session 
    * l'étudiant qui ont reussi ne seront pas récupéré au session suivante 
    * @param $idsession identifiant de la session  selectionnée 
    */

    public static function scopeEtudiantParSession($query,$idsession){

        return $query->leftJoin('etudiants_succes', 'etudiants.idetudiants', '=', 'etudiants_succes.idetudiants')
                        ->whereRaw('(etudiants_succes.idetudiants is NULL  OR etudiants_succes.idsessions >='.$idsession.')');
                        

    }

    /**
    * recupere  les étudiants en tenant compte de la session 
    * l'étudiant qui ont reussi ne seront pas récupéré au session suivante 
    * @param $idsession identifiant de la session  selectionnée 
    */

    public static function scopeEtudiantCodeParSession($query,$idsession){

        return $query->leftJoin('codes', 'codes.idetudiants', '=', 'etudiants.idetudiants')
                        ->where('codes.idsessions',$idsession);
                        

    }

    /**
    * recupere  les étudiants avec son bulletin
    * Il faur préalablement recuperer les etudiant par session
    */

    public static function scopeEtudiantGetBulletin($query,$idsessions){

        return $query->leftJoin('bulletins', 'bulletins.idetudiants', '=', 'etudiants.idetudiants')
                   ;
                        

    }




}
