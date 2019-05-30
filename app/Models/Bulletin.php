<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
     /**
     * définit la clé primaire personalisée.
     *
     * @var array
     */
    protected $primaryKey = 'idbulletins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file','idetudiants','idcodes','idsessions'
    ];

     /**
    * recupere  les bulletins en tenant compte de l'auditoire'
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function scopeBulletinParAuditoire($query,$idauditoires){

        return $query->leftJoin('etudiants', 'etudiants.idetudiants', '=', 'bulletins.idetudiants')
                     // ->leftJoin('auditoires', 'auditoires.idauditoires', '=', 'etudiants.idauditoires')
                     ->where('etudiants.idauditoires','=',$idauditoires);
                        

    }
    


    /**
    * recupere  les bulletins en tenant compte de la session 
    * l'étudiant qui ont reussi ne seront pas récupéré au session suivante 
    * @param $idsession identifiant de la session  selectionnée 
    */

    public static function scopeBulletinParSession($query,$idsession){

        return $query->where('idsessions',$idsession);
                        

    }
}
