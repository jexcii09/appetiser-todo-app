<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class PaginateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
			'paginate' => 'required|boolean',
			'per_page' => 'required_if:paginate,1'
		];
    }

    protected function failedValidation(Validator $validator)
    {
        if($this->wantsJson())
        {
            $response = response()->json([
                'message' => 'Some errors occurred',
                'errors' => $validator->errors()
            ], 422);        
        }else{
            $response = response()->json([
                'message' => 'Some errors occurred',
                'errors' => $validator->errors()
            ], 422);   
        }
            
        throw (new ValidationException($validator, $response))
        ->errorBag($this->errorBag);     
    }
}
