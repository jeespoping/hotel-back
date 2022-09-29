<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CreateDescriptionRequest extends FormRequest
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
            'hotel_id' => "required|exists:hotels,id",
            'amount' => "required|integer",
            'type' => ["required", Rule::in(['ESTANDAR', 'JUNIOR', 'SUITE'])],
            'accommodation' => ["required", Rule::in(['SENCILLA', 'DOBLE', 'TRIPLE', 'CUADRUPLE'])]
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
