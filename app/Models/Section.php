<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
     /**
     * définit la clé primaire personalisée.
     *
     * @var array
     */
    protected $primaryKey = 'idsections';


    /**
    * 
    * @return 
    */
    public static function getDataSectionBySectionAndSession($idsections,$idsessions){

    	$nbrAuditoire = Auditoire::selectRaw('count(*) as nbrAuditoire, auditoires.idsections')
    					->groupBy('auditoires.idsections')->where('auditoires.idsections',$idsections);

        $nbrEtudiant = Etudiant::getBySectionAndSession($idsections,$idsessions)
                        ->selectRaw('count(*) as nbrEtudiant,auditoires.idsections')
                        ->groupBy('auditoires.idsections');

        $nbrCode = Code::getBySectionAndSession($idsections,$idsessions)
                        ->selectRaw('count(*) as nbrCode,auditoires.idsections')
                        ->groupBy('auditoires.idsections');

        $nbrCodeActif = Code::getBySectionAndSession($idsections,$idsessions)
                        ->selectRaw('count(*) as nbrCodeActif,auditoires.idsections')
                        ->where('codes.active',1)->groupBy('auditoires.idsections');

        $nbrCodeNoActif = Code::getBySectionAndSession($idsections,$idsessions)
                        ->selectRaw('count(*) as nbrCodeNoActif,auditoires.idsections')
                        ->where('codes.active',0)->groupBy('auditoires.idsections');

        $nbrCodeUtilise = Code::getBySectionAndSession($idsections,$idsessions)
                        ->selectRaw('count(*) as nbrCodeUtilise,auditoires.idsections')
                        ->where('codes.statut',1)
                        ->groupBy('auditoires.idsections');


        $data = self::leftJoinSub($nbrAuditoire, 'nbrAuditoire', function ($join) {
                        $join->on('sections.idsections', '=', 'nbrAuditoire.idsections');
                    })
        			->leftJoinSub($nbrEtudiant, 'nbrEtudiant', function ($join) {
                        $join->on('sections.idsections', '=', 'nbrEtudiant.idsections');
                    })
                    ->leftJoinSub($nbrCode, 'nbrCode', function ($join) {
                        $join->on('sections.idsections', '=', 'nbrCode.idsections');
                    })
                    ->leftJoinSub($nbrCodeActif, 'nbrCodeActif', function ($join) {
                        $join->on('sections.idsections', '=', 'nbrCodeActif.idsections');
                    })
                    ->leftJoinSub($nbrCodeNoActif, 'nbrCodeNoActif', function ($join) {
                        $join->on('sections.idsections', '=', 'nbrCodeNoActif.idsections');
                    })
                    ->leftJoinSub($nbrCodeUtilise, 'nbrCodeUtilise', function ($join) {
                        $join->on('sections.idsections', '=', 'nbrCodeUtilise.idsections');
                    })
                    ->where('sections.idsections',$idsections)
        ->first();

 
                                        

        return $data;
    }
}
