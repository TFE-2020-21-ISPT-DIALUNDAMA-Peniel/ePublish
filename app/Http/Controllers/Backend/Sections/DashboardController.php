<?php

namespace App\Http\Controllers\Backend\Sections;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Publication;
use App\Models\Session;
use App\Models\Section;
use App\Models\Auditoire;
use App\Models\Code;
use App\DataTables\Section\ListAuditoiresBySectionDataTable;
use App\DataTables\Section\ListEtudiantsByAuditoireDataTable;
use App\Http\Requests\CodeActivatedFormRequest;


class DashboardController extends Controller
{

    /****
    * Renvoi la vue index 
    * avec les sessions disponibles
    *
    ****/
 	public function index()
    {
        // redirection vers la dernière session publiée
        if (Publication::lastPublished()) {

            return redirect()->route('section.show',$lastPublished->idsessions);
        }

    	$session = Session::get();
    	if($session->isNotEmpty()){
      		return view('backend.sections.index',['sessions'=>$session]);    
    	}
           abort(500);
    }


    /**
    * affiche un tableau avec la liste des auditoires 
    * en tenant compte de la section
    * @param Session $session 
    * @return Vue liste des auditoires
    */

    public function getAuditoiresBySection(Session $session, ListAuditoiresBySectionDataTable $listAuditoiresDataTable)
    {
    	return $listAuditoiresDataTable->with([
                                                'idsections'=>request()->user()->idsections,
                                                'idsessions'=>$session->idsessions
                                            ])      
    								  ->render('backend.sections.listAuditoires');

    }

    /**
    * affiche la liste des etudiants d'un auditoire
    * en tenant compte de la section et la session
    * @param Session $session 
    * @return Vue liste des etudiants d'un auditoire
    */

    public function getEtudiantsByAuditoire(Session $session, Auditoire $auditoire, ListEtudiantsByAuditoireDataTable $listEtudiantsDataTable){
    	
         return $listEtudiantsDataTable->with([
    											'idauditoires'=> $auditoire->idauditoires,
    											'idsessions'=> $session->idsessions,
    											'idsections' => request()->user()->idsections,
                                                'auditoires_lib'=> $auditoire->lib,

    										])
    								  ->render('backend.sections.listEtudiants');
    }

    /**
    * l'activation ou la désactivation d'un code d'accès
    *
    **/
    public function codeActivated(CodeActivatedFormRequest $codeRequest, Code $code){
        $code->active = $code->active == 0  ? 1 : 0;
        $code->save();
        return redirect()->back();
    }

}
		