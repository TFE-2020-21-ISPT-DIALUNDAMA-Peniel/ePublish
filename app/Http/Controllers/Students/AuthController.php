<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Code;


class AuthController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      session(['student' => false]);// initialisation pour la middlware
      $content = view('students.auth')->render();
       return response($content);
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
            'name.required' => 'Entrez votre nom ou votre matricule ',
            'code' => "bail|
                        required|
                        min:6|
                        codeExist|
                        isCodeSessionActive:".session('sessionActive')."|
                        codeIsActive|codeEqualStudent:".$request['name']

        ]);

        //Si la requette est valide
      
        if ($validate) {

           $student = Code::getStudentAndCode($request['code']);
           session(['student' => $student]);
           return redirect()->route('publish.show',getPublishUrl());
            
       }
    }
}