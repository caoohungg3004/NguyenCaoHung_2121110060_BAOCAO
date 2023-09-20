<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>['required'],
            'link'=>['required'],
            'position'=>['required']

        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'Tên thương hiệu không được để trống',


            'link.required'=>'đường dẫn không được để trống',
            'position.required'=>'position không được để trống'

        ];
    }
}
