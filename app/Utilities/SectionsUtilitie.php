<?php 


namespace App\Utilities;

use App\Models\Etudiant;
use App\Models\Auditoire;
use App\Models\Code; 

class SectionsUtilitie
{
	// private $idsection;



	// /**
	//  * Create a new Auth manager instance.
	//  *
	//  * @param  identifiant de la session
	//  * @return void
	// */
 //    public function __construct()
 //    {
 //    	if (is_integer(request()->user()->idsections)) {
 //        	$this->idsection =(request()->user()->idsections);
 //    	}
 //    	// -------------------------------
 //    	// exception
 //    }



 //    /**
 //     * Renvoi les données de statistique de la section
 //     * en tenant compte de la session demandée
 //     * @param  identifiant de la session
 //     * @return array dataStat
 //    */

 //    public  function getStatData($idsession,$idauditoire = null){

 //    	if($idauditoire === null){
	//     	return collect([
	//             'nbrAuditoires' => Auditoire::where('idsections',$this->idsection)->count(),
	//             'nbrStudents' => Etudiant::getBySectionAndSession($this->idsection,$idsession)->count(),
	//             'nbrCodes' => Code::getBySectionAndSession($this->idsection,$idsession)->count(),
	//             'nbrCodesActifs' => Code::getBySectionAndSession($this->idsection,$idsession,['active'=>'1'])->count(),
	//             'nbrCodesNoActifs' => Code::getBySectionAndSession($this->idsection,$idsession,['active'=>'0'])->count(),
	//             'nbrCodesUtilise' => Code::getBySectionAndSession($this->idsection,$idsession,['codes.statut'=>'1'])->count()

	//         ]);
 //    	}

 //    	return collect([
 //            'nbrStudents' => Etudiant::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire)->count(),
 //            'nbrCodes' => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire)->count(),
 //            'nbrCodesActifs' =>  Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire,['codes.active'=>'1'])->count(),
 //            'nbrCodesNoActifs' => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire,['codes.active'=>'0'])->count(),
 //            'nbrCodesUtilise' => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire,['codes.statut'=>'1'])->count(),

 //        ]);


 //    }

 //    public function getDataAuditoire($idsession){

 //    	/**
 //        ||||||||||||||||||||||||||||||||||||||||||||
 //        * A Ameliorer pour la performance
 //        ||||||||||||||||||||||||||||||||||||||||||||
 //        **/
 //        $auditoires = Auditoire::getBySection($this->idsection);
 //        $dataAuditoires = collect([]);
 //        $i=1;
 //        foreach ($auditoires as $auditoire) {
 //            $dataAuditoires->push([
 //                "id" =>$i++,
 //                "idauditoires" =>$auditoire->idauditoires,
 //                "lib"=>$auditoire->lib,
 //                "nbrEtudiants" => Etudiant::getBySectionSessionAndAuditoire($this->idsection,$idsession,$auditoire->idauditoires)->count(),
 //                "nbrCodes" => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$auditoire->idauditoires)->count(),
 //                "nbrCodesActifs" => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$auditoire->idauditoires,['codes.active'=>'1'])->count(),
 //                "nbrCodesNoActifs" => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$auditoire->idauditoires,['codes.active'=>'0'])->count(),
 //                "nbrCodesUtilises" => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$auditoire->idauditoires,['codes.statut'=>'1'])->count(),

 //            ]); 
            
 //        }
 //        return $dataAuditoires;

 //    }

    public static function getDataEtudiant($idsection,$idsession,$idauditoire){
        
    	if (request()->isMethod('post')) {

    		if (!empty(request()->name) && request()->name !='?') {
                // dd('p');
    		$etudiants = Etudiant::getStudentAndCodeBySectionSectionAndAuditoire($idsection,$idsession,$idauditoire,request()->name)->orderBy('etudiants.nom')->paginate(session('paginate'));
    		}
            elseif (isset(request()->showEntries) && is_int((int) request()->showEntries)) {
                session(['paginate'=>(int) request()->showEntries]);
                $etudiants = Etudiant::getStudentAndCodeBySectionSectionAndAuditoire($idsection,$idsession,$idauditoire)->orderBy('nom')->paginate(session('paginate'));
            }
    		else{
    			$etudiants = Etudiant::getStudentAndCodeBySectionSectionAndAuditoire($idsection,$idsession,$idauditoire)->orderBy('nom')->paginate(session('paginate',25));
    		}
                            
    	}
    	else
    	{
    		$etudiants = Etudiant::getStudentAndCodeBySectionSectionAndAuditoire($idsection,$idsession,$idauditoire)->orderBy('nom')->paginate(session('paginate',25));
                          
        }

        return $etudiants;
    }



}