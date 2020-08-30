<?php

declare (strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlternativeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'description' => ['string', 'nullable'],
        ];
    }

    /**
     * Get data from incoming request
     *
     * @return array
     */
    public function data(): array
    {
        return [
            'name'        => $this->name,
            'description' => $this->description,
        ];
    }
}
