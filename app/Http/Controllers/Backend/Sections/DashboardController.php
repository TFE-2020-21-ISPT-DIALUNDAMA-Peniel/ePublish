<?php

namespace App\Http\Controllers\BackEnd\Sections;

use Illuminate\Http\Request;
use App\Http\Requests\CodeActivatedFormRequest;
use App\Http\Requests\FindStudentFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Auditoire;
use App\Models\Session;
use App\Models\Section;
use App\Models\Etudiant;
use App\Models\Code;
use App\Utilities\CodeUtilitie;



class DashboardController extends Controller
{


    /****
    * Renvoi la vue index avec les sessions
    *
    ****/

    public function index()
    {
        $lastPublished = \App\Models\Publication::lastPublished();
        if ($lastPublished) {
            return redirect()->route('section.show',$lastPublished->idsessions);
        }
    	$session = \App\Models\Session::get();
    	if($session->isNotEmpty()){
      		return view('backend.sections.index',['sessions'=>$session]);    
    	}
           abort(500);
    }

    /**
    * affiche les infos des statistiques de la section au session selectionée 
    *
    *
    * @param $id identifiant de la Session 
    */

    public function show(Section $section,Session $session)
    {
        $idsections = request()->user()->idsections;
        $idsession = $session->idsessions;
        // $dataStat = $section->getStatData($idsession);
        // dd(\App\Models\Section::getDataSectionBySectionAndSession(1,1));
        $dataStat = Section::getDataSectionBySectionAndSession($idsections,$idsession);
        $dataAuditoires = Auditoire::getDataAuditoireBySectionAndSession($idsections,$idsession);
        // $dataAuditoires = $section->getDataAuditoire($idsession);
        $content = view('backend.sections.section',
                    [
                        'section'=>$dataStat,
                        // 'dataStat'=>$dataStat,
                        // 'dataAuditoires' => $dataAuditoires,
                        'auditoires' => $dataAuditoires,
                        'idsession' => $idsession,
                    ])->render();
        return response($content);
    }

    /**
    * renvoi le donnée d'un auditoire specifique
    *
    **/
    public function showAuditoire(Session $session, Auditoire $auditoire){
        $idsections = request()->user()->idsections;
        $idsession = $session->idsessions;
        $idauditoire = $auditoire->idauditoires;

        if (request()->isMethod('post')) {
           request()->validate(['name' => 'required|max:45']);
        }



        $dataStat = Auditoire::getDataAuditoireBySectionAndSession($idsections,$idsession,$idauditoire);
        // $dataStat = $section->getStatData($idsession,$idauditoire);
        // $dataEtudiants = $section->getDataEtudiant($idsession,$idauditoire);
        $dataEtudiants = \App\Utilities\SectionsUtilitie::getDataEtudiant($idsections,$idsession,$idauditoire);

        /** 
        * Si l' auditoire n'est pas trouvé 
        * donc l'idsection de l'utilisateur ne correspond pas
        * au idsection de l'auditoire
        * @return on bloque l'accès
        **/
        if ($dataStat == null) {
            abort(401);
        }
        $content = view('backend.sections.auditoire',[
                'section'=>$dataStat,
                // 'dataEtudiants' => $dataEtudiants['data'],
                'etudiants' => $dataEtudiants,
                // 'paginate' => $dataEtudiants['paginate'],
                'auditoire' => \App\Models\Auditoire::find($idauditoire),
            ])->render();
    

        return response($content);


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
