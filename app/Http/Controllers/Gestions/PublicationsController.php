<?php

namespace App\Http\Controllers\Gestions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Models\Publication;
use App\Models\Bulletin;
use App\Models\Etudiant;
use Carbon\Carbon;

use Flashy;

class PublicationsController extends Controller
{
    // Publie une publication
    public static function publish(PublicationRequest $request){
    	// on recupere le nbr d'étudiants et de bulletins
    	$nbrBulletin = Bulletin::BulletinParSession($request->idsessions)->BulletinParAuditoire($request->idauditoires)->count();
    	$nbrEtudiant = Etudiant::EtudiantParAuditoire($request->idauditoires)->EtudiantParSession($request->idsessions)->count();

    	// On vérifie si le nbr des bulletins est égale au nbr des étudiants
    	if ($nbrBulletin == 0) {
    		//Pas de publication
    		Flashy::error('Impossible de publier | Aucun bulletin uploader',route('jury.getBulletinByAuditoire',[$request->idsessions,$request->idauditoires]));
    		return redirect()->back();
    	}
    	elseif ($nbrBulletin > 0) {
    		if ($nbrBulletin == $nbrEtudiant || $request->force_publication){
    			if(self::savePublish($request)){
	    			Flashy::message('Publication effectué avec succèss');
	    			return redirect()->route('jury.getPublicationBySession',[$request->idsessions]); //route getPublication
    			}else{
    				return redirect()->route('jury.getPublicationBySession',[$request->idsessions]);
    			}

    		}
    		elseif($nbrBulletin < $nbrEtudiant){
    			// msg erreur et possibilité de forcer la publication
    			$message = " ";
    			$nbrEtudiantManque = $nbrEtudiant-$nbrBulletin;
    			if ($nbrEtudiantManque  == 1){
    				$message = '<strong>'.$nbrEtudiantManque."</strong> étudiant sur  <strong>".$nbrEtudiant."<strong>  n'a pas de bulletin affecté à son nom .";
    			}else{

    			$message = "<strong> ".$nbrEtudiantManque." </strong> étudiants sur  <strong>".$nbrEtudiant."</strong>  n'ont pas des bulletins affectés à leurs noms .";
    			}

    			// les routes
    			$routeAjoutBulletin = route('jury.getBulletinByAuditoire',[$request->idsessions,$request->idauditoires]);
    			$data = $request;
    			// $routeForcePublication = route('jury.forcePublication',)
    			// dd($request->request);
    			return view('backend.utilities.force_publication',compact('message','routeAjoutBulletin','data'));
    		}
    	}
    } 

    // Modifie une publication
    public function update(UpdatePublicationRequest $request){
        $publication = Publication::find($request->idpublications);
    }

    // Enregistre la publication dans la BD
    private static function savePublish(PublicationRequest $request){
    	// Valeur par defaut
    	$date_publication = NOW();
    	$statut = 1;
    	// on vérifie si le mode a été spécifier
    	if ($request->mode_publication == 'immediatement') {
    		$date_publication = NOW();
    		$statut = 1;
    	}elseif ($request->mode_publication == 'planifier' && !empty($request->date_publication && $request->date_publication > $date_publication )) {
    		$date_publication = $request->date_publication;
    		$statut = 2;
    	}else{
    		Flashy::error('Une erreur est survenue lors du traitement de la publication... Veiller préciser une date de publication valide');
    		return false;
    	}

    	// On enregistre dans la BD
    	return Publication::updateOrCreate(
    		[
    			'idsessions' => $request->idsessions,
    			'idauditoires' => $request->idauditoires,
    		],

    		[
    			'date_publication' => new Carbon($date_publication),
    			'statut' => $statut
    		]
    	);
    }


}
