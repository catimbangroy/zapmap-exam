<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'latitude.required' => __('Latitude is required.'),
            'latitude.numeric' => __('Latitude should be a number.'),
            'longitude.required' => __('Latitude is required.'),
            'longitude.numeric' => __('Latitude should be a number.'),
            'radius.required' => __('Radius is required.'),
            'radius.numeric' => __('Radius should be a number.'),
        ];
    }
}
