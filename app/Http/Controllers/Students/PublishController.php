<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Http\Controllers\Controller;


class PublishController extends Controller
{
      /**
     * Rédirige vers la Show methode
     * Pour corriger une bug
     * @return redirection
     */

    public function index()
        {
          
            return redirect()->route('publish.show',session('student')->nom.'?c='.session('student')->code);
           
        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        
        $idcode = session('student')->code;
        $matricule = session('student')->matricule;
        $bulletin = DB::table('bulletins')->where('id_code',$idcode)->where('matricule_etudiants',$matricule)->first(); 
        $imgBulletin = get_bulletin_img($bulletin->file);
         return view('students.publish',['bulletin'=>$bulletin]);  
    }

   /**
     * Affiche un bulletin PDF en format jpg
     *
     * @param  chemin du fichier
     * @funct get_bulletin_img \App\helpers
     * @return \Illuminate\Http\Response
     */
    public function viewBulletin($pathToFile){
        $response = response()->file(get_bulletin_img($pathToFile));
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
        return response()->download(get_bulletin_pdf($pathToFile));
            
    }
    


}
