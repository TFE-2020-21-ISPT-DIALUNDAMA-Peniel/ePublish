<?php

namespace App\Http\Controllers\Gestions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CodesController extends Controller
{
    // renvoi une chaine des caractères unique  pour un code d'accès

	public static function getUniqueCode(){
		$code = strtoupper(str_random(8));
		if(DB::table('codes')->where('code',$code)->count() != 0){
			return getUniqueCode();
		}
		return $code;
	}


}
