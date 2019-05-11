<?php

namespace App\Http\Controllers\Backend\Jury;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auditoire;
use App\DataTables\Jury\ListAuditoiresDataTable;
use App\DataTables\Jury\ListEtudiantsByAuditoireDataTable;

class DashboardController extends Controller
{
    
    /****
    * Renvoi la vue index 
    *
    ****/

    public function index()
    {
		return view('backend.jury.index');
    }

    /****
    * Affiche la liste des auditoires
    * Répartis par section 
    *
    ****/

    public function showAuditoires(ListAuditoiresDataTable $dataTables)
    {
        $auditoires = Auditoire::getAuditoireGroupBySection();

		return view('backend.jury.liste_auditoires',compact('auditoires'));
        // return $dataTables->render('backend.jury.liste_auditoires');
    }


    /****
    * Affiche la liste des etudiant
    * d'un auditoire
    ****/

    public function showEtudiantsByAuditoires(Auditoire $auditoire, ListEtudiantsByAuditoireDataTable $dataTables)
    {
        // $auditoires = Auditoire::getAuditoireGroupBySection();
        return $dataTables->with(['idauditoires' => $auditoire->idauditoires])
                            ->render('backend.jury.liste_etudiants',['auditoire'=>$auditoire]);

        // return view('backend.jury.liste_auditoires',compact('auditoires'));
    }




}
