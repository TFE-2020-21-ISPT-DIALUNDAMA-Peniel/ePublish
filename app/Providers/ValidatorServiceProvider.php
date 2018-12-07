<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;  
use App\Models\Code;



class ValidatorServiceProvider extends ServiceProvider
{


    private $code;



    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Vérifie si le code d'accès existe à la BD
         *
         * @return bolean
         */
        Validator::extend('codeExist', function ($attribute, $value, $parameters, $validator) {
            $this->code = Code::where('code',$value)->first();
            if ($this->code !== null) {
             return true;
            }
            return false;
        });


        /**
         * Vérifie si le code d'accès correpond à la session active
         *
         * @return bolean
         */
        Validator::extend('isCodeSessionActive', function ($attribute, $value, $parameters, $validator) {
             if ($this->code !== null) {
                if ($this->code->id_sessions == $parameters[0]) {
                    return true;
                }
             }
             return false;
        });

         /**
         * Vérifie si le code d'accès est activé
         *
         * @return bolean
         */
        Validator::extend('codeIsActive', function ($attribute, $value, $parameters, $validator) {
             if ($this->code !== null) {
                 return $this->code->active == 1;
             }
             return false;
        });

        /**
         * Vérifie si le code d'accès correpond avec le nom o la matricule 
         *
         * @return bolean
         */
        Validator::extend('codeEqualStudent', function ($attribute, $value, $parameters, $validator) {
            if ($this->code!== null) {
             return $this->verifiezMatriculeRequetteCorrepondMatriculeTableCodes($this->code->matricule_etudiant,$parameters[0]);              
            }
            return false;
        });


    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    /**
     * Vérifie si la matricule ou le nom de l'étudiant correpond avec la matricule/codes
     *
     * @param  matricule de la table codes
     * @param  student => le nom ou la matricule de la request
     * @return boolean
     */

    private function verifiezMatriculeRequetteCorrepondMatriculeTableCodes($matricule,$student){
        $students = DB::table('etudiants')
                                          ->where('nom',$student)
                                          ->orWhere('matricule',$student)
                                          ->get(['matricule','nom']);
        //Si la recherche trouve plusieurs noms
        if (!empty($students)) {
            foreach ($students as $student) {
              if ($matricule == $student->matricule) {
                  return true;        
              }
            }
        }
        return false;
    }

}

