<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Models\Bulletin;  
use App\Http\Controllers\Controller;


class PublishController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['codeAuth'])->except(['viewBulletin','dowloadBulletin']);
        $this->middleware('noCache',['only' => 'show']);
        $this->middleware('viewBulletin', ['only' => 'viewBulletin']);
        $this->middleware('viewBulletin', ['only' => 'dowloadBulletin']);
    }

    /**
     * Rédirige vers la Show methode
     * Pour corriger une bug
     * @return redirection
     */

    public function index()
        {
          
            return redirect()->route('publish.show',getPublishUrl());
           
        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        /////////////////////////////////////////////
        // !!!gerer les fichier dirrectement au serveur
        /////////////////////////////////////////////
        
        $idcode = session('student')->idcodes;
        $matricule = session('student')->matricule;
        $bulletin = Bulletin::where('idcodes',$idcode)->where('matricule_etudiant',$matricule)->first(); 
        if ($bulletin != null) {
            return view('frontend.students.publish',['bulletin'=>$bulletin]);  
        }

        return abort(404);
        /////////////////////////////////////////////
        //  RETOURNEZ UNE VUE PAS DE BULLETIN
        /////////////////////////////////////////////
        // return view('frontend.students.noPublish');
    }

   /**
     * Affiche un bulletin PDF en format jpg
     *
     * @param  chemin du fichier
     * @funct get_bulletin_img \App\helpers
     * @return \Illuminate\Http\Response
     */
    public function viewBulletin($pathToFile){
        $response = response()->file(get_path_bulletin_img($pathToFile));
        return $response;
    }

   /**
     * force le navigateur a telecharger le fichier pdf du bulletin
     *
     * @param  chemin du fichier
     * @funct get_bulletin_img \App\helpers
     * @return \Illuminate\Http\Response
     */
    public function dowloadBulletin($pathToFile){
        return response()->download(get_path_bulletin_pdf($pathToFile));
            
    }
    


}
