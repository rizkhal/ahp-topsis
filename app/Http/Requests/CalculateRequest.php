<?php

declare (strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateRequest extends FormRequest
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
            'notes'       => ['nullable', 'string'],
            'candidate'   => ['required', 'array'],
            'alternative' => ['required', 'array'],
            'ahp'         => ['required', 'array'],
            'topsis'      => ['required', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'candidate.required'   => 'Kriteria tidak boleh kosong',
            'alternative.required' => 'Data alternative tidak boleh kosong',
        ];
    }

    public function data(): array
    {
        return [
            'notes'       => $this->notes,
            'candidate'   => $this->candidate,
            'alternative' => $this->alternative,
            'ahp'         => $this->ahp,
            'topsis'      => $this->topsis,
        ];
    }
}
