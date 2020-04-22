<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Exceptions\HttpResponseException;

class CustomRequest extends FormRequest
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
        return [
            'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'Сообщение не может быть пустым',
        ];
    }


     /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors=["errors"=>$validator->errors()->all()];
      // echo json_encode($errors);
      //return response()->json(['message' => 'Os dados fornecidos não são válidos.'],422);
       // throw (new ValidationException($validator));

       throw new HttpResponseException(response()->json(['message' => 'Os dados fornecidos não são válidos.'],422));
    }


}
