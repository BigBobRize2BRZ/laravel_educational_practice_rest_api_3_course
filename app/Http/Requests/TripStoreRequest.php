<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripStoreRequest extends FormRequest
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
            'number_trip' => ['required', 'string', 'max:50', 'unique:trips'],
            'departure_date' => ['required', 'date'],
            'arrival_date' => ['required', 'date', 'after:departure_date'],
            'bus_id' => ['required', 'exists:buses,id'],
            'route_id' => ['required', 'exists:routes,id'],
        ];
    }
}
