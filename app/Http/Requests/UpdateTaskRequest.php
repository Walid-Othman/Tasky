<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
        
             return [
            'title' =>['sometimes', 'max:50', 'string'],
             'description' =>['sometimes','nullable', 'string'],
             'is_high_priority' => ['sometimes','boolean'],
             'is_done'=>['sometimes','boolean']
        ];
       
    }

    protected function prepareForValidation()
{
    $this->merge([
        'is_done' => filter_var($this->is_done, FILTER_VALIDATE_BOOLEAN),
        'is_high_priority' => filter_var($this->is_high_priority, FILTER_VALIDATE_BOOLEAN),
    ]);
}
}
