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
            'student'     => ['required', 'string'],
            'notes'       => ['required', 'string'],
            'criteria'    => ['required', 'array'],
            'alternative' => ['required', 'array'],
            'ahp'         => ['required', 'array'],
            'topsis'      => ['required', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'student.required'     => 'Siswa tidak boleh kosong',
            'criteria.required'    => 'Kriteria tidak boleh kosong',
            'alternative.required' => 'Data alternative tidak boleh kosong',
        ];
    }

    public function data(): array
    {
        return [
            'student'     => $this->student,
            'notes'       => $this->notes,
            'criteria'    => $this->criteria,
            'alternative' => $this->alternative,
            'ahp'         => $this->ahp,
            'topsis'      => $this->topsis,
        ];
    }
}
