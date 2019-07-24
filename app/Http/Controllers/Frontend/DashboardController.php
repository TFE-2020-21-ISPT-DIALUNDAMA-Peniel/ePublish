<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gestions\BulletinsController;
use App\Http\Requests\AuthentificationPublicationFormRequest;
use App\Http\Requests\StudentAuthFormRequest;
use App\Http\Requests\DowloadBulletinRequest;
use App\Models\Auditoire;
use App\Models\Etudiant;
use App\Models\Session;
use App\Models\Gestion_annee as annee;
use App\Models\Publication;
use App\Models\Code;
use App\Models\Bulletin;


class DashboardController extends Controller
{
	/**
	* Renvoi le formulaire de publication
	* Choix session,année et auditoire
	**/
    public function index(){
    	return view('frontend.students.welcome');
    }

    /**
	* Authentifie l'étudiant avec son code d'accès
	* d'une publication valide
	*
	* Vérification de la publication
	* @param $annee l'année academique
	* @param $session la session
	* @param $auditoire l'auditoire
	**/
    public function authentification(AuthentificationPublicationFormRequest $request){
        $publication = Publication::isPublished($request->idsessions,$request->idauditoires,$request->idgestion_annees);
        //Si la requette est en ajax; on renvoi le lien de redirection
        if($request->ajax()){
            return route('students.show_authentification_form',$publication->idpublications);
        }
        return redirect()->route('students.show_authentification_form',$publication->idpublications);
    	
    }

    public function showAuthentificationForm(Publication $publication){
    	$session = Session::find($publication->idsessions);
    	$auditoire = Auditoire::find($publication->idauditoires);
         //Si la requette est en ajax; on renvoi le lien de redirection
        if(request()->ajax()){
            return route('students.show_authentification_form',$publication->idpublications);
        }
    	return view('frontend.students.auth',compact('session','auditoire','publication'));
    }

    public function getBulletin(StudentAuthFormRequest $request){
    	if($code = Code::Where('code',$request->code)->first()){
    		if($bulletin = Bulletin::where('idcodes',$code->idcodes)->first()){
    			// bulletin
    			$etudiant = Etudiant::EtudiantJoinAuditoire()->find($bulletin->idetudiants);
    			$bulletin_path_pdf = $bulletin->file;
    			$bulletin_path_img = BulletinsController::getPathBulletinImg($bulletin->file);
    			return view('frontend.students.publish',compact('etudiant','bulletin_path_pdf','bulletin_path_img'));
                // return redirect()->route('students.showBulletinStudent',[$code->idsessions,$etudiant->idetudiants,$code->code]);
    		}else{
    			// view pas de bulletin
                return abort(404,'Bulletin introuvable');
    			// return abort(404,'Bulletin introuvable');
    		}
    		
    	}else{
    		return abort(404,'Code d\'accès introuvable');

    	}

    }

     /**
     * force le navigateur a telecharger le fichier pdf du bulletin
     *
     * @param  chemin du fichier
     * @funct get_bulletin_img \App\helpers
     * @return \Illuminate\Http\Response
     */
    public function dowloadBulletin(DowloadBulletinRequest $request){

        return response()->download($request->path_file);
            
    }
}
