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
     * Renvoi la dernière publication
     *
     * @return publication
     */
    public static function lastPublished(){
      $id = self::max('idpublications') ? self::max('idpublications') : -1;
      $lastPub = self::where('idpublications',$id)->first();
      return $lastPub != null ? $lastPub : false;
    }
}
