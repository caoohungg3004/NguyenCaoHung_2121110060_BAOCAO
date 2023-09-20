<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
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
            'name'=>['required','unique:2121110060_contact'],
            // 'email'=>['required'],
            'metakey'=>['required'],
            'metadesc'=>['required'],
            // 'user_id'=>['required'],
            // 'title'=>['required'],
            // 'content'=>['required'],
            // 'phone'=>['required'],
            // 'reply_id'=>['required']


        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'Tên thương hiệu không được để trống',
            'name.unique'=>'Tên thương hiệu không được để trống',


            // 'email.required'=>'email không được để trống',
            // 'phone.required'=>'sđt không được để trống',
            // 'title.required'=>'title không được để trống',
            // 'content.required'=>'nội dung không được để trống',

            'metakey.required'=>'Từ khóa không được để trống',
            'metadesc.required'=>'Mô tả không được để trống',
            // 'user_id.required'=>'Danh mục không được trống',
            // 'reply_id.required'=>'Danh mục không được trống'


        ];
    }
}
