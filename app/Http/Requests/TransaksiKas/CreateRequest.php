<?php

namespace App\Http\Requests\TransaksiKas;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateRequest extends FormRequest
{
    public $validator = null;
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
            'total' => 'required|integer',
            'tanggal' => 'required',
            'keterangan' => 'required',
            'tipe' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'total' => 'total',
            'tanggal' => 'tanggal',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
