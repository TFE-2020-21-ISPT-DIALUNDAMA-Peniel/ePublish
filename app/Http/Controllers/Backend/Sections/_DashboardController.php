<?php

// namespace App\Http\Controllers\BackEnd\Sections;

// use Illuminate\Http\Request;
// use App\Http\Requests\CodeActivatedFormRequest;
// use App\Http\Requests\FindStudentFormRequest;
// use App\Http\Controllers\Controller;
// use App\Models\Publication;
// use App\DataTables\Section\ListAuditoiresBySectionDataTable;
// use App\Models\Auditoire;
// use App\Models\Session;
// use App\Models\Section;
// use App\Models\Etudiant;
// use App\Models\Code;
// use App\Utilities\CodeUtilitie;

// use Yajra\Datatables\Datatables;
// use App\DataTables\EtudiantDataTable;

// class DashboardController extends Controller
// {


//     /****
//     * Renvoi la vue index 
//     * avec les sessions
//     *
//     ****/

//     public function index()
//     {
//         // redirection vers la dernière session publiée
//         if (Publication::lastPublished()) {

//             return redirect()->route('section.show',$lastPublished->idsessions);
//         }

//     	$session = Session::get();
//     	if($session->isNotEmpty()){
//       		return view('backend.sections.index',['sessions'=>$session]);    
//     	}
//            abort(500);
//     }

//     /**
//     * affiche un tableau avec la liste des auditoires 
//     * en tenant compte de la section
//     * @param $id identifiant de la Session 
//     */

//     public function getAuditoires(Section $section,Session $session, ListAuditoiresBySectionDataTable $dataTable)
//     {

//         $idsections = request()->user()->idsections;
//         // $idsession = $session->idsessions;
//         return  $dataTable->with('idsections',$idsections)
//                           ->render('backend.sections.listAuditoires');








//         // $content = view('backend.sections.listAuditoires',
//         //             [
//         //                 'table' => $dataTable,
//         //                 'idsession' => $idsession,
//         //             ])->render();
//         // return response($content);
//     }
























//     /**
//     * affiche les infos des statistiques de la section au session selectionée 
//     * la listes des auditoires de la  section
//     *
//     * @param $id identifiant de la Session 
//     */

//     public function show(Section $section,Session $session)
//     {
//         $idsections = request()->user()->idsections;
//         $idsession = $session->idsessions;
//         // $dataStat = $section->getStatData($idsession);
//         // dd(\App\Models\Section::getDataSectionBySectionAndSession(1,1));
//         // $dataStat = Section::getDataSectionBySectionAndSession($idsections,$idsession);
//         $dataAuditoires = Auditoire::getDataAuditoireBySectionAndSession($idsections,$idsession);
//         // $dataAuditoires = $section->getDataAuditoire($idsession);
//         $content = view('backend.sections.section',
//                     [
//                         // 'section'=>$dataStat,
//                         // 'dataStat'=>$dataStat,
//                         // 'dataAuditoires' => $dataAuditoires,
//                         'auditoires' => $dataAuditoires,
//                         'idsession' => $idsession,
//                     ])->render();
//         return response($content);
//     }

//     /**
//     * renvoi le donnée d'un auditoire specifique
//     *
//     **/
//     public function showAuditoire(Session $session, Auditoire $auditoire){
//         $idsections = request()->user()->idsections;
//         $idsession = $session->idsessions;
//         $idauditoire = $auditoire->idauditoires;

//         if (request()->isMethod('post')) {
//            request()->validate(['name' => 'required|max:45']);
//         }



//         $dataStat = Auditoire::getDataAuditoireBySectionAndSession($idsections,$idsession,$idauditoire);
//         // $dataStat = $section->getStatData($idsession,$idauditoire);
//         // $dataEtudiants = $section->getDataEtudiant($idsession,$idauditoire);
//         $dataEtudiants = \App\Utilities\SectionsUtilitie::getDataEtudiant($idsections,$idsession,$idauditoire);

//         /** 
//         * Si l' auditoire n'est pas trouvé 
//         * donc l'idsection de l'utilisateur ne correspond pas
//         * au idsection de l'auditoire
//         * @return on bloque l'accès
//         **/
//         if ($dataStat == null) {
//             abort(401);
//         }
//         $content = view('backend.sections.auditoire',[
//                 'section'=>$dataStat,
//                 // 'dataEtudiants' => $dataEtudiants['data'],
//                 'etudiants' => $dataEtudiants,
//                 // 'paginate' => $dataEtudiants['paginate'],
//                 'auditoire' => \App\Models\Auditoire::find($idauditoire),
//             ])->render();
    

//         return response($content);


//     }

    

//     /**
//      * Process datatables ajax request.
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function etudiantDataTable()
//     {
//         // $sql = \App\Models\Etudiant::query();
//         // ----------------------------------------------------------------------------------
//         $sql = \App\Models\Etudiant::getStudentAndCodeBySectionSectionAndAuditoire(1,1,1);
//         // -----------------------------------------------------------------------------------
//         // dd($sql->first());   
//         return Datatables::of($sql)->make();

//         // return  response()->json($sql);
//     }

//     /**
//     * l'activation ou la désactivation d'un code d'accès
//     *
//     **/
//     public function codeActivated(CodeActivatedFormRequest $codeRequest, Code $code){
//         $code->active = $code->active == 0  ? 1 : 0;
//         $code->save();
//         return redirect()->back();
//     }






//     public function testTable(EtudiantDataTable $dataTable){
// // dump($dataTable->request());
//         // $table = $dataTable->dataTable(\App\Models\Etudiant::EtudiantActif()->EtudiantParAuditoire(10)->get());
//         // $dataTable->query(\App\Models\Etudiant::EtudiantActif()->EtudiantParAuditoire(11)->get());  
//         return $dataTable->with('id',12)->render("backend.utilities.ListEtudiantTable");
//     }



// }
