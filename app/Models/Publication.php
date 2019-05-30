<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{

    /**
     * définit la clé primaire personalisée.
     *
     * @var array
     */
    protected $primaryKey = 'idpublications';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idsessions','idauditoires','statut','date_publication'
    ];
    // protected $dateFormat = 'd/m/Y H:m';

    /**
     * Evénement éloquent lors de la creation d'un étudiant
     * l'année academique en cours est recuperée automatique
     */
    protected static function boot(){
        parent::boot();

        static::creating(function($publications){
            $publications->annee = Gestion_annee::getAnneeAcademiqueEnCours()->idgestion_annees;

        });
    }

   	/**
     * Verifie si le resultat de la session demandée est  publieés
     *
     * @param  $idSession identifiant de la sesssion
     * @param  $idAuditoire identifiant de l'auditoire
     * @param  $idAnnee identifiant de l'année
     * @return bolean
     */
    public static function isPublished($idSession,$idAuditoire,$idAnnee){
       return self::where('publications.statut','1')
		                        ->where([
		                                    'publications.idsessions' => $idSession,
		                                    'publications.idauditoires'	=> $idAuditoire,
		                                    'publications.annee'	=> $idAnnee
		                        ])//contraite de la requette
		                        ->exists(['idpublications']);
    }


    /**
     * return le statut de la publication
     *
     * @param  $idSession identifiant de la sesssion
     * @param  $idAuditoire identifiant de l'auditoire
     * @param  $idAnnee identifiant de l'année
     * @return bolean
     */
    public static function getStatutPublication($idSession,$idAuditoire){
       $publication =  self::where([
                            'publications.idsessions' => $idSession,
                            'publications.idauditoires' => $idAuditoire,
                            'publications.annee'    => Gestion_annee::getAnneeAcademiqueEnCours()->idgestion_annees
                ])->first();

       //si on trouve une publication on verifie son statut
       if ($publication) {
           if ($publication->statut == 0) {
              return 'suspendu';
           }else if ($publication->statut == 1) {
               return 'publier';
           }else if ($publication->statut == 2) {
               return 'planifier';
           }
       }
       return null;
    }



    /**
     * Renvoi la dernière publication
     *
     * @return publication
     */
    public static function lastPublished(){
      $id = self::max('idpublications') ? self::max('idpublications') : -1;
      $lastPub = self::where('idpublications',$id)->first();
      return $lastPub != null ? $lastPub : false;
    }

    /**
    * recupere  les publications en tenant compte de la session 
    * @param $idsession identifiant de la session  selectionnée 
    */

    public static function scopePublicationParSession($query,$idsession){

        return $query->where('idsessions',$idsession);
                        

    }

    /**
    * recupere  les publications en joignant les donnée des auditoires 
    */

    public static function scopePublicationJoinAuditoire($query){

        return $query->join('auditoires', 'auditoires.idauditoires', '=', 'publications.idauditoires');
                        

    }
}
