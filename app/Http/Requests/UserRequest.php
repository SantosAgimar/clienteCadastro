<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
          /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422));
    }

          /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email' .($userId ? $userId : null),
            'password' => 'required|min:6'
        ];
    }
        /**
     * RETORNA MENSAGEM PERSONALIZADA PORTUGUÊS BRASIL
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'Campo nome obrigatorio!',
            'email.required'    => 'Campo email obrigatorio!',
            'email.email'       => 'Email invalido!',
            'email.unique'      => 'Email ja cadastrado!',
            'password.required' => 'Campo senha obrigatorio!',
            'password.min'      => 'Senha minimo :min caracteres!'
        ];
    }
}
