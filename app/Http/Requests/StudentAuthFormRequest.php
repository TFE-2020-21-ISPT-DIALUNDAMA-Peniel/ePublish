<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name.required' => 'Entrez votre nom ou votre matricule ',
            'code' => "bail|
                        required|
                        min:8|
                        codeExist|
                        isCodeSessionActive:".session('idsessions')."|
                        codeIsActive|
                        codeEqualStudent:".request('name')
        ];
    }
}
