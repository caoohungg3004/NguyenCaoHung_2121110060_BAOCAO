<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
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
            'name'=>['required','unique:2121110060_slider'],

            'link'=>['required'],
            'position'=>['required']


        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>'Tên slider không được để trống',
            'name.unique'=>'Tên slider đã tồn tại',
            'link.required'=>'Link này không được để trống',
            'position.required'=>'position này không được để trống'


        ];
    }
}
