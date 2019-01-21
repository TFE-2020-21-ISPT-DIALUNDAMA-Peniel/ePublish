<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;  
use App\Models\Code;



class ValidatorServiceProvider extends ServiceProvider
{


    private $code;
    private $student;


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
            $this->code = Code::where('code',strtoupper($value))->first();
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
                if ($this->code->idsessions == $parameters[0]) {
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
         * Vérifie si le code d'accès correpond avec le nom ou la matricule 
         *
         * @return bolean
         */
        Validator::extend('codeEqualStudent', function ($attribute, $value, $parameters, $validator) {
            if ($this->code!== null) {
             return $this->verifiezMatriculeRequetteCorrepondMatriculeTableCodes($this->code->idetudiants,$parameters[0]);              
            }

            return false;
        });

         /**
         * Vérifie si l'étudiant esten ordre
         *
         * @return bolean
         */
        Validator::extend('studentIsActive', function ($attribute, $value, $parameters, $validator) {
             if ($this->code !== null) {
                // si c'est la prémière foi on change le statut du code à 1
                if ($this->code->statut == 0) {
                    Code::where('idcodes',$this->code->idcodes)->update(['statut'=>'1']);
                }
                 return $this->student->statut == 1;
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

    private function verifiezMatriculeRequetteCorrepondMatriculeTableCodes($code_idetudiants,$student){
        $students = DB::table('etudiants')
                                          ->where('nom',$student)
                                          ->orWhere('matricule',$student)
                                          ->get();
        //Si la recherche trouve plusieurs noms
        if (!empty($students)) {
            foreach ($students as $student) {
              if ($code_idetudiants == $student->idetudiants) {
                  $this->student = $student;
                  return true;        
              }
            }
        }
        return false;
    }

}

