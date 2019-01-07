<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoire extends Model
{
    /**
     * définit la clé primaire personalisée.
     *
     * @var array
     */
    protected $primaryKey = 'idauditoires';

    
    public static function getBySection($idSection){
    	return self::where('idsections',$idSection)->orderBy("idpromotions")
    				->get(['idauditoires','lib']);
    }
}
