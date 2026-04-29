<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteUpdateRequest extends FormRequest
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
            'id' => 'required|exists:routes,id',
            'number_route' => 'sometimes|integer|unique:routes,number_route,' . $this->id,
            'start_stop' => 'sometimes|string|max:255',
            'end_stop' => 'sometimes|string|max:255',
            'price' => 'sometimes|integer|min:0',
        ];
    }
}
