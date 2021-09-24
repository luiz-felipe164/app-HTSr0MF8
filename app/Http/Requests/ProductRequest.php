<?php

namespace App\Http\Requests;

use App\Rules\Quantity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
        if ($this->method() === 'PUT') {
            return [
                'SKU' => 'required',
                'quantity' => ['required', 'numeric', new Quantity],
                'action'   => 'required|in:remove,add'
            ];
        }

        return [
            'name' => 'required|string|max:255',
            'SKU' => 'required|unique:products',
            'quantity' => ['required', 'numeric', new Quantity],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.*
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
