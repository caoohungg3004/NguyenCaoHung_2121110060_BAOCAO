<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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

            'detail'=>['required'],
            'metakey'=>['required'],
            'metadesc'=>['required'],
            'topic_id'=>['required'],
            'title'=>['required'],
            'type'=>['required'],
            'image'=>['required'],


        ];
    }

    public function messages(): array
    {
        return [

            'detail.required'=>'Từ khóa không được để trống',

            'image.required'=>'Ảnh không được để trống',

            'metakey.required'=>'Từ khóa không được để trống',
            'metadesc.required'=>'Mô tả không được để trống',
            'topic_id.required'=>'Mã chủ đề không được trống',
            'type.required'=>'chọn kiểu thương hiệu'

        ];
    }
}
