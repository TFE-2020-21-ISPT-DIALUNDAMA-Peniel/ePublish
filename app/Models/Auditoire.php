<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoire extends Model
{
    /**
     * définit la clé primaire personalisée.
     *
     * @var array
     */
    protected $primaryKey = 'idauditoires';

    
    public static function getBySection($idSection){
    	return self::where('idsections',$idSection)->orderBy("idpromotions")
    				->get(['idauditoires','lib']);
    }

    /**
    * 
    * @return 
    */
    public static function getDataAuditoireBySectionAndSession($idsections,$idsessions,$idauditoires=null){

        $nbrEtudiant = Etudiant::getBySectionAndSession($idsections,$idsessions)
                        ->selectRaw('count(*) as nbrEtudiant,auditoires.idauditoires as nbrEtudiant_idauditoires')
                        ->groupBy('auditoires.idauditoires');

        $nbrCode = Code::getBySectionAndSession($idsections,$idsessions)
                        ->selectRaw('count(*) as nbrCode,auditoires.idauditoires as nbrCode_idauditoires')
                        ->groupBy('auditoires.idauditoires');

        $nbrCodeActif = Code::getBySectionAndSession($idsections,$idsessions)
                        ->selectRaw('count(*) as nbrCodeActif,auditoires.idauditoires as nbrCodeActif_idauditoires')
                        ->where('codes.active',1)->groupBy('auditoires.idauditoires');

        $nbrCodeNoActif = Code::getBySectionAndSession($idsections,$idsessions)
                        ->selectRaw('count(*) as nbrCodeNoActif,auditoires.idauditoires as nbrCodeNoActif_idauditoires')
                        ->where('codes.active',0)->groupBy('auditoires.idauditoires');

        $nbrCodeUtilise = Code::getBySectionAndSession($idsections,$idsessions)
                        ->selectRaw('count(*) as nbrCodeUtilise,auditoires.idauditoires as nbrCodeUtilise_idauditoires')
                        ->where('codes.statut',1)
                        ->groupBy('auditoires.idauditoires');


        $data = self::leftJoinSub($nbrEtudiant, 'nbrEtudiant', function ($join) {
                        $join->on('auditoires.idauditoires', '=', 'nbrEtudiant.nbrEtudiant_idauditoires');
                    })
                    ->leftJoinSub($nbrCode, 'nbrCode', function ($join) {
                        $join->on('auditoires.idauditoires', '=', 'nbrCode.nbrCode_idauditoires');
                    })
                    ->leftJoinSub($nbrCodeActif, 'nbrCodeActif', function ($join) {
                        $join->on('auditoires.idauditoires', '=', 'nbrCodeActif.nbrCodeActif_idauditoires');
                    })
                    ->leftJoinSub($nbrCodeNoActif, 'nbrCodeNoActif', function ($join) {
                        $join->on('auditoires.idauditoires', '=', 'nbrCodeNoActif.nbrCodeNoActif_idauditoires');
                    })
                    ->leftJoinSub($nbrCodeUtilise, 'nbrCodeUtilise', function ($join) {
                        $join->on('auditoires.idauditoires', '=', 'nbrCodeUtilise.nbrCodeUtilise_idauditoires');
                    })
                    ->where('auditoires.idsections',$idsections);
        if ($idauditoires != null) {
        return $data->where('auditoires.idauditoires',$idauditoires)
                    ->first([
                    'auditoires.idauditoires',
                    'lib',
                    'abbr',
                    'nbrEtudiant',
                    'nbrCode',
                    'nbrCodeActif',
                    'nbrCodeNoActif',
                    'nbrCodeUtilise'
                ]);
        }
       
        return $data->get([
                'auditoires.idauditoires',
                'lib',
                'abbr',
                'nbrEtudiant',
                'nbrCode',
                'nbrCodeActif',
                'nbrCodeNoActif',
                'nbrCodeUtilise'
            ]) ;

    }
}
