<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusUpdateRequest extends FormRequest
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
            'id' => 'required|exists:buses,id',
            'registration_number' => 'sometimes|string|max:20|unique:buses,registration_number,' . $this->id,
            'model' => 'sometimes|string|max:255',
            'seats' => 'sometimes|integer|min:1',
        ];
    }
}
