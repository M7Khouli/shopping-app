<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->is('api/user/register'))
        return [
            'name'=>'required',
            'email'=>'required|unique:users,email|email',
            'password'=>'required|min:8|max:32',
        ];
        if ($this->is('api/user/login'))
        return [
            'email'=>'required|email',
            'password'=>'required|min:8|max:32',
        ];
    }
    /**
    * Get custom attributes for validator errors.
    *
    * @return array<string, string>
    */
    public function attributes(): array
    {
        return [
            'name' => 'اسم المنتج',
            'email'=>'البريد الالكتروني',
            'password'=>'كلمة المرور'
        ];
    }


    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
    public function messages(): array
    {
    return [
            '*.required' => 'يرجى ادخال حقل :attribute',
            'password.min'=>'كلمة المرور يجب ان تكون اكثر من ثمان محارف',
            'password.max'=>'كلمة المرور يجب ان تكون اقل من اثنين وثلاثين محرف',
            'email.email'=>'يرجى ادخال بريد الكتروني صحيح'
    ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors'=>$validator->errors()->all()],422));

    }
}
