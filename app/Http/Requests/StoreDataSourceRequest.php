<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreDataSourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'          =>  'required|max:50|string',
            'description'   =>  'required|max:250|string',
            'file'          =>  'required|max:5120|image',
            'type'          =>  'required|in:1,2,3|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Name should be string!',
            'name.max'   =>  'Max 50 characters allowed in name!',
            'description.string' => 'Description should be string!',
            'description.max'   =>  'Max 250 characters allowed in description!',
            'file.image' => 'File should be image!',
            'type.in' => 'Type should be 1, 2 or 3'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
