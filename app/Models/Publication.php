<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
   	/**
     * Verifie si le resultat de la session demandée est  publieés
     *
     * @param  $idSession identifiant de la sesssion
     * @param  $idAuditoire identifiant de l'auditoire
     * @param  $idAnnee identifiant de l'année
     * @return bolean
     */
    public static function isPublished($idSession,$idAuditoire,$idAnnee){
       return $idpublication = self::where('publications.statut','1')
		                        ->where([
		                                    'publications.idsessions' => $idSession,
		                                    'publications.idauditoires'	=> $idAuditoire,
		                                    'publications.annee'	=> $idAnnee
		                        ])//contraite de la requette
		                        ->exists(['idpublications']);
    }
}
