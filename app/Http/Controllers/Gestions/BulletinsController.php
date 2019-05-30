<?php

namespace App\Http\Controllers\Gestions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\PdfToImage\Pdf;
use App\Models\Gestion_annee as Annee;
use App\Models\Session;
use App\Models\Auditoire;
use App\Models\Etudiant;
use App\Models\Bulletin;
use Storage;

class BulletinsController extends Controller
{

	public static function store(Request $request,Annee $annee,Session $session,Auditoire $auditoire){
		$file = $request->bulletins->getClientOriginalName();
		$file_name = explode('.',$file)[0]; //on recupere le nom sans l'extention

		// On verifie si le bulletin est en format pdf
		if($request->bulletins->guessClientExtension() != 'pdf' ){
			return response()->json(['error'=>'Extension invalide pour le fichier "'.$file.'". Seules les extensions "pdf" sont autorisées.']);

		}
		// On vérifie si le bulletin à une correspondance dans l'auditoire et session selectionnée
		if (!$etudiant = Etudiant::EtudiantParAuditoire($auditoire->idauditoires)->EtudiantParSession($session->idsessions)->where('matricule',$file_name)->first(['etudiants.idetudiants'])){
			return response()->json(['error'=>$file_name.' Ne correspond à aucun "matricule" d\'un étudiant de '.$auditoire->abbr.' en '.$session->abbr]);
		}
		// Si tout ok on copie le fichier dans le serveur
		$etudiant = Etudiant::EtudiantCodeParSession($session->idsessions)->find($etudiant->idetudiants);
		$path = self::getPathStorageBulletinByAuditoire($annee,$session,$auditoire);
		$path_file  = $request->bulletins->move($path,$file);
		// on stoque dans la BD
		Bulletin::UpdateOrCreate([
									'idetudiants'=>$etudiant->idetudiants,
									'idcodes' => $etudiant->idcodes,
								],
								[
									'file' => $path.DIRECTORY_SEPARATOR.$path_file,
									'idsessions' => $session->idsessions
								]
							);

		return response()->json(['uploaded'=>'Bulletin uploader avec succès']);

	}

















  //   public static function getBulletin($path){
  //   	if (file_exists($path)) {
		// 	$pdf = new Pdf($path);
		// 	$pdf->_saveImage($pathImg,$file);
		// 	$format =$pdf->getOutputFormat();
		
		// 	return $pathImg.'.'.$format;	
		// }
  //   }

    /**
	 * renvoi le lien du stockage de bulletin
	 * 
	 * @param  
	 * @return url de pdf
	 * 
	 */

  	private static function getPathStorageBulletinByAuditoire(Annee $annee,Session $session,Auditoire $auditoire){

		$path = storage_path('app'.DS.'bulletins'.DS.$annee->annee_format.DS.str_slug($session->abbr).DS.str_slug($auditoire->abbr));
		
		return $path;	
    	
    }

    /**
	 * renvoi le lien du stockage de bulletin en img
	 * 
	 * @param url du pdf
	 * @return url d' img
	 * 
	 */

  	public static function getPathBulletinImg($path_file){
		if (file_exists($path_file)) {
			// on defini le nom du fichier img
  			$tab_path = explode(DIRECTORY_SEPARATOR,$path_file);
  			$tab_path = collect($tab_path);
  			$taille = $tab_path->count() - 3;
  			$file_name  = $tab_path->slice($taille)->implode('-');
  			$file_name = explode('.',$file_name)[0];
  			$path_img = storage_path('app'.DS.'public'.DS.'bulletin_img'.DS.$file_name.'.jpg');
  			$url_img = url('storage'.DS.'bulletin_img'.DS.$file_name.'.jpg');
  			// si l'img existe on la retourne
  			if (file_exists($path_img)) {
				return $url_img;
			}
			// sinon on en crée une
			$pdf = new \Spatie\PdfToImage\Pdf($path_file);
			$img = $pdf->saveImage($path_img);
			$format =$pdf->getOutputFormat();
		
			return $url_img;	
		} 
		return null; 	
    }
}