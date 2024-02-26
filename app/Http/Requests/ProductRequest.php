<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
        if($this->is('api/product/*')){
            return [
            'name'=>'unique:products,name',
                'price'=>'numeric',
                'brand'=>'string',
                'description'=>'string',
                'color'=>'string',
                'quantity'=>'numeric',
                'availability'=>'bool',
                'size'=>'string',
                'category'=>'string',
                'subcategory'=>'string'
        ];
        }
        return [
            'name'=>'required',
            'price'=>'required|numeric',
            'photo'=>'image',
            'photo_dir'=>'string',
            'brand'=>'string|required',
            'description'=>'string|required',
            'color'=>'string|required',
            'quantity'=>'numeric|required',
            'availability'=>'bool|required',
            'size'=>'string',
            'category'=>'string|required',
            'subcategory'=>'string|required'
        ];
    }

    protected function prepareForValidation(): void
    {
    if($this->route()->getActionMethod()=='store'){
    $this['photo_dir']='public/img/no-image.png';

    if($this->photo){
        $photoPath = $this->file('photo')->store('public/img');
        $this['photo_dir']=$photoPath;
        }
    }
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
            'price'=>'السعر',
            'brand'=>'الماركة',
            'description'=>'الوصف',
            'color'=>'اللون',
            'quantity'=>'الكمية',
            'availability'=>'التوافرية',
            'category'=>'الصنف',
            'subcategory'=>'النوع'
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
    ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors'=>$validator->errors()->all()],422));

    }
}
