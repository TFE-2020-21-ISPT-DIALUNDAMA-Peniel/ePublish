<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Publication;

class AuthentificationPublicationFormRequest extends FormRequest
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
            if (!Publication::isPublished(request()->idsessions,request()->idauditoires,request()->idgestion_annees)) {
                $validator->errors()->add('','Publication non disponible !');
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
            'idsessions' => 'bail|required|exists:sessions',
            'idgestion_annees' => 'required|exists:gestion_annees',
            'idauditoires' => 'required|exists:auditoires',
        ];
    }
}
