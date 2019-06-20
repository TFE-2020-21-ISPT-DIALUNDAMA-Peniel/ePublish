<?php

namespace App\Http\Controllers\Gestions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Etudiants_succes;
use App\Models\Session;

class Etudiants_succesController extends Controller
{
    public static function etudiantSuccess($request){
    	if (
    		Etudiants_succes::updateOrCreate([
    		'idetudiants'=>$request->idetudiants,
    		'idsessions'=>$request->idsessions,
    	]))
    	{

     		return true;
    	}

    	return false;
    }


    public static function delete($request){
        $etudiants_succes = Etudiants_succes::find($request->idetudiants_succes);
    	if($etudiants_succes->forceDelete()){
    		return true;
    	}
    	return false;
    }
}
