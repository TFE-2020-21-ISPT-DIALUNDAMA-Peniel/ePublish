<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Code;
use App\Models\Etudiant;

class StudentAuthFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

     /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // Vérificiation de la publication publié
        $validator->after(function ($validator) {
            if($code = Code::where('code',request()->code)->first()){
                $idauditoires =  Etudiant::find($code->idetudiants)->idauditoires; 
                if ($idauditoires != request()->idauditoires) {
                    $validator->errors()->add('','Vérifier la promotion selectionnée!');
                }
            }
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idsessions.required' => 'Une erreur est survenue',
            'idauditoires.required' => 'Une erreur est survenue',
            'name.required' => 'Entrez votre nom ou votre matricule ',
            'code' => "bail|
                        required|
                        min:8|
                        codeExist|
                        isCodeSessionActive:".request('idsessions')."|
                        codeIsActive|
                        codeEqualStudent:".request('name')."|
                        studentIsActive"

        ];
    }
}
