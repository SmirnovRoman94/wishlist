<?php

namespace App\Http\Requests\Present;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'holiday_id' => 'required|integer|exists:holidays,id',
            'title' => 'required|string',
            'link' => 'required|string',
            'description' => 'string|nullable',
            'image' => 'string|nullable'
        ];
    }
}
