<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteStoreRequest extends FormRequest
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
            'number_route' => 'required|integer|unique:routes',
            'start_stop' => 'required|string|max:255',
            'end_stop' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ];
    }
}
