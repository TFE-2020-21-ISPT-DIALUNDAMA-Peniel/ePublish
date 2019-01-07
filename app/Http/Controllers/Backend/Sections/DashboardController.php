<?php

namespace App\Http\Controllers\BackEnd\Sections;

use Illuminate\Http\Request;
use App\Http\Requests\CodeActivatedFormRequest;
use App\Http\Requests\FindStudentFormRequest;
use App\Http\Controllers\Controller;
use App\Utilities\Section;
use App\Utilities\UCode;



class DashboardController extends Controller
{

    /****
    * Renvoi la vue index avec les sessions
    *
    ****/

    public function index()
    {
        $lastPublished = \App\Models\Publication::lastPublished();
        if ($lastPublished->exists()) {
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

    public function show(Section $section, $idsession)
    {
        $dataStat = $section->getStatData($idsession);
        $dataAuditoires = $section->getDataAuditoire($idsession);
        $content = view('backend.sections.section',
                    [
                        'dataStat'=>$dataStat,
                        'dataAuditoires' => $dataAuditoires,
                        'idsession' => $idsession,
                    ])->render();
        return response($content);
    }


    public function showAuditoire(Section $section,$idsession,$idauditoire){
        if (request()->isMethod('post')) {
           request()->validate(['name' => 'required|max:45']);
        }
        $dataStat = $section->getStatData($idsession,$idauditoire);
        $dataEtudiants = $section->getDataEtudiant($idsession,$idauditoire);

        $content = view('backend.sections.auditoire',[
                'dataStat'=>$dataStat,
                'dataEtudiants' => $dataEtudiants['data'],
                'paginate' => $dataEtudiants['paginate'],
                // 'idsession' => $idsession,
            ])->render();
    

        return response($content);


    }


    public function codeActivated(CodeActivatedFormRequest $request, UCode $code){
        $code->updateActivated(request()->idcode);
        return redirect()->back();
    }



}
