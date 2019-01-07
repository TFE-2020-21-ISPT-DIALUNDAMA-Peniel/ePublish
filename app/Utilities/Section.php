<?php 


namespace App\Utilities;

use App\Models\Etudiant;
use App\Models\Auditoire;
use App\Models\Code; 

class Section
{
	private $idsection;


	/**
	 * Create a new Auth manager instance.
	 *
	 * @param  identifiant de la session
	 * @return void
	*/
    public function __construct()
    {
    	if (is_integer(request()->user()->idsections)) {
        	$this->idsection =(request()->user()->idsections);
    	}
    	// -------------------------------
    	// exception
    }



    /**
     * Renvoi les données de statistique de la section
     * en tenant compte de la session demandée
     * @param  identifiant de la session
     * @return array dataStat
    */

    public  function getStatData($idsession,$idauditoire = null){

    	if($idauditoire === null){
	    	return collect([
	            'nbrAuditoires' => Auditoire::where('idsections',$this->idsection)->count(),
	            'nbrStudents' => Etudiant::getBySectionAndSession($this->idsection,$idsession)->count(),
	            'nbrCodes' => Code::getBySectionAndSession($this->idsection,$idsession)->count(),
	            'nbrCodesActifs' => Code::getBySectionAndSession($this->idsection,$idsession,['active'=>'1'])->count(),
	            'nbrCodesNoActifs' => Code::getBySectionAndSession($this->idsection,$idsession,['active'=>'0'])->count(),
	            'nbrCodesUtilise' => Code::getBySectionAndSession($this->idsection,$idsession,['codes.statut'=>'1'])->count()

	        ]);
    	}

    	return collect([
            'nbrStudents' => Etudiant::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire)->count(),
            'nbrCodes' => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire)->count(),
            'nbrCodesActifs' =>  Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire,['codes.active'=>'1'])->count(),
            'nbrCodesNoActifs' => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire,['codes.active'=>'0'])->count(),
            'nbrCodesUtilise' => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire,['codes.statut'=>'1'])->count(),

        ]);


    }

    public function getDataAuditoire($idsession){

    	/**
        ||||||||||||||||||||||||||||||||||||||||||||
        * A Ameliorer pour la performance
        ||||||||||||||||||||||||||||||||||||||||||||
        **/
        $auditoires = Auditoire::getBySection($this->idsection);
        $dataAuditoires = collect([]);
        $i=1;
        foreach ($auditoires as $auditoire) {
            $dataAuditoires->push([
                "id" =>$i++,
                "idauditoires" =>$auditoire->idauditoires,
                "lib"=>$auditoire->lib,
                "nbrEtudiants" => Etudiant::getBySectionSessionAndAuditoire($this->idsection,$idsession,$auditoire->idauditoires)->count(),
                "nbrCodes" => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$auditoire->idauditoires)->count(),
                "nbrCodesActifs" => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$auditoire->idauditoires,['codes.active'=>'1'])->count(),
                "nbrCodesNoActifs" => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$auditoire->idauditoires,['codes.active'=>'0'])->count(),
                "nbrCodesUtilises" => Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$auditoire->idauditoires,['codes.statut'=>'1'])->count(),

            ]); 
            
        }
        return $dataAuditoires;

    }

    public function getDataEtudiant($idsession,$idauditoire){
    	
    	if (request()->isMethod('post')) {
    		if (!empty(request()->name)) {
    		$etudiants = Etudiant::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire,request()->name)->orderBy('nom')->paginate(25);
    		}
    		else{
    			$etudiants = null;
    		}
                            
    	}
    	else
    	{
    		$etudiants = Etudiant::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire)->orderBy('nom')->paginate(25);
                          
        }

        $dataEtudiants = collect([]);
        $i=1;
        foreach ($etudiants as $etudiant) {
            $code = Code::getBySectionSessionAndAuditoire($this->idsection,$idsession,$idauditoire,['codes.matricule_etudiant'=>$etudiant->matricule])->first(['idcodes','code','active','codes.statut']);
            $dataEtudiants->push([
                "id" =>$i++,
                "matricule" =>$etudiant->matricule,
                "nom"=>$etudiant->nom,
                "postnom"=>$etudiant->postnom,
                "prenom"=>$etudiant->prenom,
                "idcode" => $code ? $code->idcodes : '-',
                "code" => $code ? $code->code : '-',
                "codeIsActive" => $code ? $code->active : '-',
                "codeStatut" => $code ? $code->statut : '-', 

            ]); 
        }
        $dataEtudiants=['paginate' => $etudiants->links(), 'data'=>$dataEtudiants];

        return $dataEtudiants;
    }



}