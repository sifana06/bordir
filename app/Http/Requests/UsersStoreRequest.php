<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersStoreRequest extends FormRequest
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
        /**
         * Keterangan rule validasi
         * required->harus di isi
         * regex: -> hasus berupa alphabet
         * unique -> tidak boleh sama
         */
        return [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|unique:users,email',
            'phone' => 'required|numeric|digits_between:11,13',
            'jenis_kelamin' => 'required',
            'role' => 'required'
        ];
    }
}
