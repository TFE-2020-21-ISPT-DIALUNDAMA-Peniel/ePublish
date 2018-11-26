<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
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
        session(['sessionActive'=> null]);

        //Recupération des session active et années academique
        $sessions = DB::table('sessions')->orderBy("idsessions")->get();
        $annees = DB::table('gestion_annees')->orderBy("idgestion_annees")->get();
        
        return view('students.welcome',[
            'sessions'=>$sessions,
            'annees' => $annees
        ]);
    }

    /**
     * Store a newly created resource in storage.
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
       if($this->sessionsActiveExist(request(['session','annee']))){
        //rendu de la vue d'authentification

        //enregistrement de la session active dans la variable $_SESSION
        session(['sessionActive' => $request['session']]);
        return redirect()->route('auth.index');
       }

       session()->flash('message','Les Résultats ne sont pas disponible');
       return redirect()->route('welcome.index');
       
        
       
    }

  

    /**
     * SVerifie si la Session est active dans la BD
     *
     * @param  $request idSession et IdAnnee
     * @return bolean
     */
    private function sessionsActiveExist($req){
       $field = DB::table('session_actives')
        ->join('sessions','sessions.idsessions','session_actives.id_sessions')//table des sessions
        ->join('gestion_annees','gestion_annees.idgestion_annees','session_actives.annee')//table année academique
        ->where('session_actives.statut','1')
        ->where([
                    // 'session_actives.statut'=>'1',
                    'session_actives.idsession_active'=>$req['session'],
                    'session_actives.annee'=>$req['annee']
                ])//contraite de la requette
        ->first(['idsession_active']);
        if ($field!=null) {
            return true;
        }

        return false;
    }
}


