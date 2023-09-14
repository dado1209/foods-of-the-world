<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'per_page' => 'nullable|numeric',
            'page' => 'nullable|numeric',
            'diff_time' => 'nullable|numeric|min:0',
            'tags' => 'nullable|regex:/^(\d+,)*\d+$/',
            'tags.*' =>'numeric',
            'with' => 'nullable',
            'lang' => 'required|string|size:2',
            'category' => 'nullable'
        ];
    }
}
