<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Http\JsonResponse;

class AddPlaceRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'lat.required' => 'We require your current location(latitude)',
            'lng.required' => 'We require your current location(longitude)',
        ];

        return $messages;
    }

    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }
}
