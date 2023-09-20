<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuStoreRequest extends FormRequest
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
            'name'=>['required','unique:2121110060_menu'],
            'link'=>['required'],
            'position'=>['required']

        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'Tên thương hiệu không được để trống',
            'name.unique'=>'Tên thương hiệu đã tồn tại',

            'link.required'=>'đường dẫn không được để trống',
            'position.required'=>'position không được để trống'

        ];
    }
}
