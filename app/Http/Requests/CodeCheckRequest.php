<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CodeCheckRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'exists:reset_code_passwords']
        ];
    }

    /**
     * @throws \Exception
     */
    public function failedValidation(Validator $validator)
    {
        throw new \Exception(response()->json(["error" => "Erro no envio de dados.", "message" => $validator->errors()->first()], 422));
    }
}
