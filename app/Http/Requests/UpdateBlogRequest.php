<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'         => 'required|unique:blogs,title,'.$this->blog->id,
            'description'   => 'required',
            'thumbnail'     => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation Errors',
            'data'    => $validator->errors()
        ],500));
    }
}
