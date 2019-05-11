<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gestion_annee extends Model
{
    public static function getAnneeAcademiqueEnCours(){
    	return self::where('statut',0)->first();
    }
}
