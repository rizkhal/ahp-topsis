<?php

declare (strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriteriaRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string'],
            'bobot' => ['required', 'integer'],
            'type'  => ['required', 'string'],
        ];
    }

    public function data(): array
    {
        return [
            'name'  => $this->name,
            'bobot' => $this->bobot,
            'type'  => $this->type,
        ];
    }
}
