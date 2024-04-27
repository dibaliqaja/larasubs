<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'      => 'required|string|max:255',
            'content'    => 'required|string',
            'website_id' => 'required|integer|exists:websites,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'      => 'Title is required',
            'title.max'           => 'Title may not be greater than 255 characters',
            'content.required'    => 'Content is required',
            'website_id.required' => 'Website id is required',
            'website_id.exists'   => 'Website id is no exist',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => 'error',
            'message' => 'Validation errors',
            'data'    => $validator->errors()
        ], 422));
    }
}
