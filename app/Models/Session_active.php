<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session_active extends Model
{
	   /**
     * Verifie si la session est active
     *
     * @param  $idSession identifiant de la sesssion
     * @param  $idAuditoire identifiant de l'auditoire
     * @param  $idAnnee identifiant de l'année
     * @return App\Models\Session_active
     */
    public static function isActive($idSession,$idAuditoire,$idAnnee){
       $field = self::where('session_actives.statut','1')
                        ->where([
                                    'session_actives.idsessions' =>$idSession,
                                    'session_actives.idauditoires'	=>$idAuditoire,
                                    'session_actives.annee'	=>$idAnnee
                        ])//contraite de la requette
                        ->first(['idsession_actives']);
        if ($field != null) {
            //enregistrement de la session active dans la variable $_SESSION
            session(['sessionActive' => $field->idsession_actives]);
            return true;
        }

        return false;
    }
    
}
