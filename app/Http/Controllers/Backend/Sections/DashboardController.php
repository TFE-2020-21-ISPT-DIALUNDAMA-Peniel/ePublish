<?php

namespace App\Http\Controllers\BackEnd\Sections;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use \App\Models\Etudiant;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    /****
    * Renvoi la vue index avec les sessions
    *
    ****/

    public function index()
    {

    	$session = \App\Models\Session::get();
    	if($session->isNotEmpty()){
      		return view('backend.sections.index',['sessions'=>$session]);    
    	}

    	/*********************************
    	* RETOURNE VUE DATABASE ERREUR
    	* CREE UNE EXCEPTION
    	*********************************/
           abort(500);
    }

    /**
    * affiche les infos statistique de la section au session selectionée 
    *
    *
    * @param $id identifiant de la Session 
    */

    public function show($idsession){
        $userIdsection = request()->user()->idsections;
        //recuperation de donnée | renvoyé sous forme des collections
        $auditoires = \App\Models\Auditoire::getBySection($userIdsection);
        $etudiants = \App\Models\Etudiant::getStudentsBySectionAndSession($idsession,$userIdsection);
        $codes = \App\Models\Code::getBySection($userIdsection);

        // Tri
        $codesActifs = filterEloquent($codes,['statut'=>'1']);
        $codesNoActifs = filterEloquent($codes,['statut'=>'1'],false);
        $codesUtilises = filterEloquent($codes,['active'=>'1']);


        $nbrEtudiantsByAuditoire = filterNbrCorrespondantEloquents($auditoires,$etudiants,'etudiants');
        $nbrCodesByAuditoire = filterNbrCorrespondantEloquents($auditoires,$codes,'codes');
        $nbrCodesActifsByAuditoire = filterNbrCorrespondantEloquents($auditoires,$codesActifs,'codesActifs');
        $nbrCodesNoActifsByAuditoire = filterNbrCorrespondantEloquents($auditoires,$codesNoActifs,'codesNoActifs');
        $nbrCodesUtilisesByAuditoire = filterNbrCorrespondantEloquents($auditoires,$codesUtilises,'codesUtilises');
      
        

        // Tri des donnés pour les informations des statistiques
        $nbrAuditoires = $this->getNbrField($auditoires);
        $nbrStudents = $this->getNbrField($etudiants);
        $nbrCodes = $this->getNbrField($codes);
        $nbrCodesActifs = $codesActifs->count();
        $nbrCodesNoActifs = $codesNoActifs->count();
        $nbrCodesUtilise = $codesNoActifs->count();

        // Initialisation de variable à envoyé à la vue
        //les données de statistique par rapport à la section
        $dataStat = collect([
            'nbrAuditoires' => $nbrAuditoires,
            'nbrStudents' => $nbrStudents,
            'nbrCodes' => $nbrCodes,
            'nbrCodesActifs' => $nbrCodesActifs,
            'nbrCodesNoActifs' => $nbrCodesNoActifs,
            'nbrCodesUtilise' => $nbrCodesUtilise,

        ]);

        // les données de statistique par auditoires
            $dataAuditoires = collect([]);
            $i=1;
            foreach ($auditoires as $auditoire) {
                $dataAuditoires->push([
                    "id" =>$i++,
                    "lib"=>$auditoire->lib,
                    "nbrEtudiants" => $nbrEtudiantsByAuditoire[$auditoire->idauditoires],
                    "nbrCodes" => $nbrCodesByAuditoire[$auditoire->idauditoires],
                    "nbrCodesActifs" => $nbrCodesActifsByAuditoire[$auditoire->idauditoires],
                    "nbrCodesNoActifs" => $nbrCodesNoActifsByAuditoire[$auditoire->idauditoires],
                    "nbrCodesUtilises" => $nbrCodesUtilisesByAuditoire[$auditoire->idauditoires],

                ]); 
            }




        $content = view('backend.sections.auditoires',[
                        'dataStat'=>$dataStat,
                        'dataAuditoires' => $dataAuditoires,
                    ])->render();
            

        return response($content);
    	

    }

    /**
    * renvoi le nombre de champ d'une instance de collection eloquent
    * @param $eloquent instance d'une table eloquent
    * @return int
    */
    private function getNbrField($eloquent){
        return $eloquent->count();
    }

    // /**
    // * renvoi le champ d'une instance de collection eloquent qui repond à la clause where
    // * @param $eloquent instance d'une table eloquent
    // * @param array $where tableau 
    // * @return int
    // */
    // private function getFilterEloquent($eloquents,$field,$value,$operator='=='){

    //     $filtered = $eloquents->filter(function ($eloquent, $key, $f) {
    //         dd($f);
    //         // return $eloquent->$field.$operator.$value;
    //     });

    //     $filtered->all();
    //     dump($filtered);
    //      dd($students);

    // }


    // private function getNbrCorrespondancePrimaryKey($firstEloquents,$secondEloquents,$foreignKeys){
    //       session("count", collect([]));

    //      foreach ($firstEloquents as $firstEloquent) {
    //          $idFirstEloquent=$firstEloquent->getKeyName();
             
    //         session([
    //             "idEloquent1Value" => $firstEloquent->$idFirstEloquent,
    //             "foreignKeys" => $foreignKeys,

    //         ]);

    //         $filtered = $secondEloquents->filter(function($value, $key) {
    //               return $value->getAttributeValue(session('foreignKeys'))  ==  session('idEloquent1Value');
    //         });
    //         dd($filtered->count());

    //          session("count")->push($count);
    //     }


    //      dd(session('count'))   ; 
    //  }



}
