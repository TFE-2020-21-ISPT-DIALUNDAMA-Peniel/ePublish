<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
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
            'idsessions' => 'required|exists:sessions',
            'idauditoires' => 'required|exists:auditoires',
            'mode_publication' => 'required',
            // 'date_publication' => 'date_format : DD/MM/YYYY HH:mm'
        ];
    }
}
