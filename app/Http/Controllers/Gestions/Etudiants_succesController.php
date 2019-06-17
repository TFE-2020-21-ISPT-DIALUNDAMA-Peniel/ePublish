<?php

namespace App\Http\Controllers\Gestions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Etudiants_succes;
use App\Models\Session;

class Etudiants_succesController extends Controller
{
    public static function etudiantSuccess(Etudiant $etudiant,Session $session){
    	if (
    		Etudiants_succes::updateOrCreate([
    		'idetudiants'=>$etudiant->idetudiants,
    		'idsessions'=>$session->idsessions,
    	]))
    	{

     		return true;
    	}

    	return false;
    }


    public static function delete(Etudiants_succes $etudiants_succes){
    	if($etudiants_succes->forceDelete()){
    		return true;
    	}
    	return false;
    }
}
