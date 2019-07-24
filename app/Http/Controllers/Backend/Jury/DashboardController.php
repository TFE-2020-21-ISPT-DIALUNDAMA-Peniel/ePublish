<?php

namespace App\Http\Controllers\Backend\Jury;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gestions\BulletinsController;
use App\Http\Controllers\Gestions\PublicationsController;
use App\Http\Controllers\Gestions\Etudiants_succesController;
use App\Models\Etudiant;
use App\Models\Etudiants_succes;
use App\Models\Auditoire;
use App\Models\Session;
use App\Models\Bulletin;
use App\Models\Publication;
use App\Models\Gestion_annee as Annee;
use App\DataTables\Jury\ListAuditoiresDataTable;
use App\DataTables\Jury\ListEtudiantsByAuditoireDataTable;
use App\DataTables\Jury\ListeBulletinByAuditoireAndSessionDataTable;
use App\DataTables\Jury\NoReussiPalmaresBySessionDataTable;
use App\DataTables\Jury\ReussiPalmaresBySessionDataTable;
use App\DataTables\Jury\ListePublicationsBySessionDataTable;
use App\Http\Requests\PublicationRequest;
use App\Http\Requests\SetEtudiantSuccesRequest;
use App\Http\Requests\DeleteEtudiantSuccesRequest;
use App\Http\Requests\ImportEtudiantByAuditoireRequest;

// excel import
use App\Imports\EtudiantsImport;
use Maatwebsite\Excel\Facades\Excel;

use Flashy;


class DashboardController extends Controller
{
    
    /****
    * Renvoi la vue index 
    *
    ****/
    private $annee;

    public function __construct(){
        $this->annee = Annee::getAnneeAcademiqueEnCours();
    }

    public function index()
    {
		return view('backend.jury.index');
    }

    /****
    * Affiche la liste des auditoires
    * Pour la liste des etudiants
    * Répartis par section 
    *
    ****/

    public function showAuditoiresEtudiant()
    {
        $route = route('jury.showAuditoires');
        // dd($route);
        
		return view('backend.jury.etudiantListe_auditoires',compact('route'));
        // return $dataTables->render('backend.jury.liste_auditoires');
    }


    /****
    * Affiche la liste des auditoires
    * Pour la liste des bulletin
    * Répartis par section 
    *
    ****/

    public function showAuditoiresByBulletin(Session $session)
    {
        // $route = ['route'=>'jury.getBulletinBySection','param'=>$session];
        $route = route('jury.getBulletinBySession',$session->idsessions);

        return view('backend.jury.bulletinListe_auditoires',compact('route'));
        // return $dataTables->render('backend.jury.liste_auditoires');
    }

    // /****
    // * Affiche la liste des auditoires
    // * Répartis par section 
    // *
    // ****/

    // private function showAuditoiresByGroupeSection($route)
    // {
    //     $auditoires = Auditoire::getAuditoireGroupBySection();
       
    //     return view('backend.partials.includes.liste_auditoire',['auditoires'=>$auditoires,'route'=>$route]);
    //     // return $dataTables->render('backend.jury.liste_auditoires');
    // }


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

    /**
    * BULLETINS
    */

    /****
    * Affiche la liste des etudiant
    * Avec leurs bulletins
    * d'un auditoire
    * si aucun bulletin n'est uploader on return la vue d'upload
    ****/

    public function showBulletinByAuditoireAndSession (Session $session,Auditoire $auditoire, ListeBulletinByAuditoireAndSessionDataTable $dataTables)
    {
        $annee = $this->annee;

        // si aucun bulletin uploader on return la vue uplaod sans la liste des étudiants
        if(Bulletin::BulletinParSession($session->idsessions)->BulletinParAuditoire($auditoire->idauditoires)->first() == null){
            $btn = "";
            return view('backend.jury.upload_bulletin',compact('annee','session','auditoire','btn'));
        }

        $btn = self::getBtnStatutPublication($session->idsessions,$auditoire->idauditoires);
        // $auditoires = Auditoire::getAuditoireGroupBySection();
        return $dataTables->with([
                                    'idsessions'=>$session->idsessions,
                                    'idauditoires' => $auditoire->idauditoires,
                                    'annee' =>$annee,
                                ])
                            ->render('backend.jury.listeBulletinByAuditoire',compact('annee','session','auditoire','btn'));

        // return view('backend.jury.liste_auditoires',compact('auditoires'));
    }

    /**
    * Upload  les bulletin pdf dans le serveur
    *
    */
    public function storeBulletin(Request $request,Annee $annee,Session $session,Auditoire $auditoire){
        
        return BulletinsController::store($request,$annee,$session,$auditoire);

    }

    // Retourne un bulletin en img

    public function showBulletinImg(Request $request){
        if ($bulletin = Bulletin::find($request->idbulletins)){
            return '<img class="img-fluid" src="'.BulletinsController::getPathBulletinImg($bulletin->file).'">';
            // return response()->file(BulletinsController::getPathBulletinImg($bulletin->file));

        }
        return 'Aucun bulletin trouvé';
    }

    /**
    * PUBLICATION
    */

    /**
    * renvoi la liste des auditoire publié par session
    */
    public function getPublicationBySession(ListePublicationsBySessionDataTable $dataTables,Session $session)
    {
        return $dataTables->with(['idsessions'=>$session->idsessions])->render('backend.jury.liste_auditoires_publication',compact('session'));
    }
    /**
    * Publier les bulletins d'un auditoire
    */
    public function publish(PublicationRequest $request)
    {
        return PublicationsController::publish($request);
    }


    /**
    * PALMARÈS
    */
     /****
    * Affiche la liste des auditoires
    * Pour le palmarès
    * Répartis par section 
    *
    ****/

    public function getPalmaresBySession(Session $session)
    {
        // $route = ['route'=>'jury.getBulletinBySection','param'=>$session];
        $route = route('jury.getPalmaresBySession',$session->idsessions);

        return view('backend.jury.bulletinListe_auditoires',compact('route'));
        // return $dataTables->render('backend.jury.liste_auditoires');
    }
    

    public function showPalmaresByAuditoireAndSession(Session $session, Auditoire $auditoire,ReussiPalmaresBySessionDataTable $dataTables1, NoReussiPalmaresBySessionDataTable $dataTables2){
        
        $dataTable1 = $dataTables1->with(['idsessions'=>$session->idsessions,'idauditoires'=>$auditoire->idauditoires])->html();
        $dataTable2 = $dataTables2->with(['idsessions'=>$session->idsessions,'idauditoires'=>$auditoire->idauditoires])->html();
        // two dataTable
        if (request()->get('param') == 'R') {
           return $dataTables2->with(['idsessions'=>$session->idsessions,'idauditoires'=>$auditoire->idauditoires])->render('backend.jury.show_palmares',compact('session','auditoire','dataTable1','dataTable2'));
        }elseif (request()->get('param') == 'NR') {
            return $dataTables1->with(['idsessions'=>$session->idsessions,'idauditoires'=>$auditoire->idauditoires])->render('backend.jury.show_palmares',compact('session','auditoire','dataTable1','dataTable2'));
        }
        return view('backend.jury.show_palmares',compact('session','auditoire','dataTable1','dataTable2'));

        // etudiants_sucess
        // return $dataTables1->with(['idsessions'=>$session->idsessions])->render('backend.jury.show_palmares',compact('session','auditoire'));

        // etudiants_no_sucess
        // return $dataTables1->with(['idsessions'=>$session->idsessions,'idauditoires'=>$auditoire->idauditoires])->render('backend.jury.show_palmares',compact('session','auditoire'));
    }

    // //
    // public function showAddEtudiantPalmaresByAuditoireAndSession(Session $session, Auditoire $auditoire, NoReussiPalmaresBySessionDataTable $dataTables){
       
    //     return $dataTables->with(['idsessions'=>$session->idsessions,'idauditoires'=>$auditoire->idauditoires])->render('backend.jury.show_add_etudiant_palmares',compact('session','auditoire'));
    // }

    // Enregistre un étudiant qui a récu à la session

    public function etudiantSucces(SetEtudiantSuccesRequest $request){
        if (Etudiants_succesController::etudiantSuccess($request)){
            Flashy::message('Opération effectuée avec succès');
            return redirect()->back();
        }
            Flashy::danger('Une erreure est survenue !!!');

    }

    // Supprime un étudiant qui a récu à la session

    public function etudiantNoSucces(DeleteEtudiantSuccesRequest $request){
        if (Etudiants_succesController::delete($request)){
            Flashy::message('Opération effectuée avec succès');
            return redirect()->back();
        }
            Flashy::danger('Une erreure est survenue !!!');

    }



    // METHODE SECONDAIRES
    /**
    * Importation des étudiants avec excel
    */

    public function importEtudiantByAuditoire(ImportEtudiantByAuditoireRequest $request){
        try {
            Excel::import(new EtudiantsImport, $request->file('file'));
            Flashy::message('Importation effectuer avec succès');
            return  redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors();

        }


        // try {
        //     Excel::import(new EtudiantsImport, $request->file('file'));
        //     Flashy::message('Importation effectuer avec succès');
        //     dd('ok');
        // } catch (\Maatwebsite\Excel\Validators\ValidationException  $e) {
        //     $failures = $e->failures();
        //     foreach ($failures as $failure) {
        //         dump($failure->row()); // row that went wrong
        //         dump($failure->attribute()); // either heading key (if using heading
        //         dump($failure->errors()); // Actual error messages from Laravel valid
        //     } 
        // }

    }



    /**
    * METHODES PRIVATE
    */
    /**
    * return le statut de publication
    * 0=>suspendu,1=>publier,2=>planifier
    */

    private static function getBtnStatutPublication($idsessions,$idauditoires){
        $statut = Publication::getStatutPublication($idsessions,$idauditoires);
        if($statut == null){
            return '<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModalCenter"><span class="h5">Publier</span>
    </button>';
            // $class = "primary";
            // $btn = "Publier";
            // $route = route('jury.')
        }else if ($statut == 'publier') {
            $class = "warning";
            $btn = "Suspendre la publication"; 
        }else if ($statut == 'planifier') {
            $class = "success";
            $btn = "Modifier l'horaire du publication"; 
        }else if ($statut == 'suspendu') {
            $class = "primary";
            $btn = "publier"; 
        }

        return '<a class="btn btn-'.$class.'" >'.$btn.'</a>';
    }

}
