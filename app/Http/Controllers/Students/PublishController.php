<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Http\Controllers\Controller;


class PublishController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
         return view('students.publish',['bulletin'=>$bulletin]);  
    }


}
