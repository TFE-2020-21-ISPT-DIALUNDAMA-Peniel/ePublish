<?php 


namespace App\Utilities;

use App\Models\Code; 

class UCode
{


	public function updateActivated($idcode){
		$code = Code::find($idcode);
		$code->active = $code->active == 0  ? 1 : 0;
		return $code->save();

	}


}