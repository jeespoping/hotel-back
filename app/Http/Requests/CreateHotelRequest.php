<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CreateHotelRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:hotels',
            'address' => 'required',
            'city' => 'required',
            'nit' => 'required|unique:hotels',
            'room' => 'required|integer'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json($error, 422)
        );
    }
}
