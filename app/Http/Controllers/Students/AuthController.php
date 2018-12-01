<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Http\Controllers\Controller;

class AuthController extends Controller
{


    private $code;
    private $student;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      session(['students' => false]);// initialisation pour la middlware
       return view('students.auth');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation du formulaire
        $validate = $request->validate([
            'name' => 'required',
            'code' => 'required'
        ]);


      
        if ($validate) {
           if($this->codeAuth($request)){
              session(['student'=>$this->student]);
            
            return redirect()->route('publish.show',$this->student->nom.'?c='.$this->student->code);
           }

           return  redirect()->route('auth.index');

       }
    }




    /**
     * Logique d'authetification du code d'access
     *
     * @param  $request
     * @return boolean
     */

    private function codeAuth(Request $request){
          //on vérifie si le code existe dans la bd
         $codes = DB::table('codes')->where('code',$request['code'])->first();
            if(!empty($codes)){
              //on vérifie s il correpond à la session sélectionée
              if ($codes->id_sessions == session('sessionActive','-1')) 
              {
                 //on vérifie si il est activé
                 if($codes->active === '1'){
                   //on vérifie s il  conresponds avec le nom ou la matricule 
                   if($this->verifiezMatriculeRequetteCorrepondMatriculeTableCodes($codes->matricule_etudiant,$request['name'])){
                        //Si c'est la prèmiere fois on modifie le statut à 1
                        if($codes->statut != 1){
                          DB::table('codes')->where('idcodes', $codes->idcodes)->update(['statut' => '1']);
                        }
                        $this->student->code = $codes->idcodes; //Initialise l'attribut code
                        return true;
                   }
                   else
                   {
                    session()->flash('message','Le code ne correpond pas au nom');
                    return false;
                   }
                }
                else
                {

                    $msg = "Le code entrée n'est pas activé. <hr> Veillez contacter votre session.";
                    session()->flash('message',$msg);
                    return false;
                }
                
               }
               else
               {
                    $url =route('welcome.index');
                    $html ='le code entrée ne correpond pas à la session seléctionée! <hr>';
                    $html .= "<a href='$url' >Selectionez la Session</a>";
                    session()->flash('message',$html);
                    return false;
                    
               }               
            }
            else
            {
                    session()->flash('message',"Code d'accès Invalide");
                    return false;
            }

        
    }
 
    /**
     * Vérifie si le matricule ou le nom de l'étudiant correpond avec le matricule/codes
     *
     * @param  matricule de la table codes
     * @param  student => le nom ou le matricule de la request
     * @return boolean
     */

    private function verifiezMatriculeRequetteCorrepondMatriculeTableCodes($matricule,$student){
        $students = DB::table('etudiants')
                                          ->where('nom',$student)
                                          ->orWhere('matricule',$student)
                                          ->get(['matricule','nom']);
        //Si la recherche trouve plusieurs noms
        if (!empty($students)) {
            foreach ($students as $student) {
              if ($matricule == $student->matricule) {
                  $this->student = $student;
                  return true;        
              }
            }
        }
        return false;
    }
 
}
