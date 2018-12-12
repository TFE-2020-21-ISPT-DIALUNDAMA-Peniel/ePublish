<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Models\Session_active;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Initialise la session active pour le middleware
        session(['student'=> null,'sessionActive'=>null]);

        //Recupération des session active et années academique
        $sessions = DB::table('sessions')->orderBy("idsessions")->get();
        $annees = DB::table('gestion_annees')->orderBy("idgestion_annees")->get();
        if($sessions != null AND $annees != null){
            return view('students.welcome',[
                'sessions'=>$sessions,
                'annees' => $annees
            ]);
        }
        /////////////////////////////////////////////
        //  RETOURNEZ UNE VUE AUCUNE SESSIONN ACTIVE
        /////////////////////////////////////////////

    }

    /**
     * Traitement du formulaire
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validation
        $request->validate([
            'session'=>'required',
            'annee'=>'required'           
        ]); 
        //Vérification des donnée soumis
       if(Session_active::isActive(request('session'),request('annee'))){
        //enregistrement de la session active dans la variable $_SESSION
        session(['sessionActive' => $request['session']]);
        //Si la requette est en ajax; on renvoi le lien de redirection
        if($request->ajax()){
            return route('auth.index');
        }
        //rendu de la vue d'authentification
        return redirect()->route('auth.index');
       }

       $message = 'Les résultats de la session sélectionnée ne sont pas disponible!';
       //Si la requette est en Ajax on retourne la réponse en json
       if ($request->ajax()) {
         $response = response()->json([
            'errors' => ['errors'=>$message]
         ]);
         $response->setStatusCode(422);
         return $response;
       }

       session()->flash('message',$message);
       
       return redirect()->back()->withInput();
       
    }

}


