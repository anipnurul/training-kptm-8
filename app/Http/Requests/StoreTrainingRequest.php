<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingRequest extends FormRequest
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
            'title' => 'required|min:2',
            'description' => 'required|min:2',
            'attachment' => 'required',
            //
        ];
    }

    public function messages(){
        return [
            'title.required' => 'sila isi tajuk',
            'title.min' => 'Tak cukup panjang',
            'description.required' => 'sila isi diskripsi',
            //'attachment' => 'required',
            //
        ];
    }
}
