<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlternativeRequest extends FormRequest
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
            'nilai' => ['required', 'integer'],
        ];
    }

    public function data(): array
    {
        return [
            'name'  => $this->name,
            'nilai' => $this->nilai,
        ];
    }
}