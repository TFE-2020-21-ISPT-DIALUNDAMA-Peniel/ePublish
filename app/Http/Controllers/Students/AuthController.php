<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      session(['codeAuth' => false]);// initialisation pour la middlware
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
            session(['codeAuth' => true]);//Affectation de la variable pour la middleware
            return redirect()->route('publish.index');
           }
           return  redirect()->route('auth.index');

       }
    }


     /**
     * Vérifie si le matricule ou le nom de l'étudiant correpond avec le matricule/codes
     *
     * @param  matricule de la table codes
     * @param  student => le nom ou le matricule de la request
     * @return boolean
     */

    private function codeXstudent($matricule,$student){
        $students = DB::table('etudiants')
                                          ->where('nom',$student)
                                          ->orWhere('matricule',$student)
                                          ->first(['matricule']);
        if (!empty($students)) {
            if ($matricule == $students->matricule) {
                return true;        
            }
        }
        return false;
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
              //on vérifie si il est activé
               if($codes->active === '1'){
                //on vérifie s il correpond à la session sélectionée
                if ($codes->id_sessions == session('sessionActive','-1')) 
                {
                   //on vérifie s il  conresponds avec le nom ou la matricule 
                   if($this->codeXstudent($codes->matricule_etudiant,$request['name'])){
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
                    $url =route('welcome.index');
                    $html ='le code entrée ne correpond pas à la session seléctionée <br>';
                    $html .= "<a href='$url' >Selectionez la Session</a>";
                    session()->flash('message',$html);
                    return false;
                }
                
               }
               else
               {
                    session()->flash('message','le code n est pas actif');
                    return false;
               }               
            }
            else
            {
                    session()->flash('message','le code est invalide');
                    return false;
            }

        
    }
  
}