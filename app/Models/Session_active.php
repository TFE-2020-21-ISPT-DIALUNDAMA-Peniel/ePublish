<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session_active extends Model
{
	  /**
     * Verifie si la session est active
     *
     * @param  $idSession identifiant de la sesssion
     * @param  $idAnnee identifiant de l'année
     * @return App\Models\Session_active
     */
    public static function isActive($idSession,$idAnnee){
       $field = self::where('session_actives.statut','1')
                        ->where([
                                    'session_actives.idsession_actives'	=>$idSession,
                                    'session_actives.annee'	=>$idAnnee
                        ])//contraite de la requette
                        ->first(['idsession_actives']);
        if ($field != null) {
            return true;
        }

        return false;
    }
    
}
