<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiants_succes extends Model
{
     /**
     * définit la clé primaire personalisée.
     *
     * @var array
     */
    protected $primaryKey = 'idetudiants_succes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idetudiants','idsessions','idgestion_annees'
    ];


    /**
     * Evénement éloquent lors de la creation d'un étudiant
     * l'année academique en cours est recuperée automatique
     */
    protected static function boot(){
        parent::boot();

        static::creating(function($etudiant){
            $etudiant->idgestion_annees = Gestion_annee::getAnneeAcademiqueEnCours()->idgestion_annees;

        });
    }

    public static function scopeJoinEtudiant($query){

        return $query->join('etudiants','etudiants_succes.idetudiants','=','etudiants.idetudiants');
                        

    }

    /**
    * recupere  les étudiants en tenant compte de la session 
    * l'étudiant qui ont reussi ne seront pas récupéré au session suivante 
    * @param $idsession identifiant de la session  selectionnée 
    */

    public static function scopeEtudiantSuccesParSession($query,$idsession){

        return $query->where('etudiants_succes.idsessions',$idsession);

    }

    // public static function scopeEtudiantNonSuccesParSession($query,$idsession){

    //     return $query->->whereRaw('(etudiants_succes.idetudiants is NULL  OR etudiants_succes.idsessions >'.$idsession.')');

    // }


}
