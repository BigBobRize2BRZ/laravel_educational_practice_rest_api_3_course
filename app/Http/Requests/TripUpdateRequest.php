<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripUpdateRequest extends FormRequest
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
            'id' => 'required|exists:trips,id',
            'number_trip' => 'sometimes|string|max:50|unique:trips,number_trip,' . $this->id,
            'departure_date' => 'sometimes|date',
            'arrival_date' => 'sometimes|date|after:departure_date',
            'bus_id' => 'sometimes|exists:buses,id',
            'route_id' => 'sometimes|exists:routes,id',
        ];
    }
}
