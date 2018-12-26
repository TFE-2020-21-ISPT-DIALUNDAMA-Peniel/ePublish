<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Models\Publication;
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
        session()->flush();
        session()->regenerate();

        //Recupération des session active, auditoire années academique
        $auditoires = DB::table('auditoires')->orderBy("idpromotions")->orderBy("idsections")->orderBy("idauditoires")->get();
        $sessions = DB::table('sessions')->orderBy("idsessions")->get();
        $annees = DB::table('gestion_annees')->orderBy("annee_debut","DESC")->get();
        if($sessions->isNotEmpty()  AND $annees->isNotEmpty()){
            return view('frontend.students.welcome',[
                'auditoires'=>$auditoires,
                'sessions'=>$sessions,
                'annees' => $annees
            ]);
        }
        /////////////////////////////////////////////
        //  RETOURNEZ UNE VUE AUCUNE SESSION ACTIVE
        /////////////////////////////////////////////
        return view('frontend.students.noPublish');

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
            'session'=>'required|int',
            'auditoire'=>'required|int',
            'annee'=>'required|int'           
        ]); 
        //Vérification des donnée soumis
       if(Publication::isPublished(request('session'),request('auditoire'),request('annee'))){
            
            // session(['sessionActive' => request('session')]); //pour gerer le middleware
            session(['idsessions' => request('session')]); //pour gerer le middleware

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


