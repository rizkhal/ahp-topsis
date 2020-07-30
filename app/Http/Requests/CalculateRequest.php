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
            'title'       => ['required', 'string'],
            'description' => ['required', 'string'],
            'criteria'    => ['required', 'array'],
            'candidate'   => ['required', 'array'],
            'row'         => ['required', 'array'],
            'pairwise'    => ['required', 'array'],
            'type'        => ['required', 'array'],
        ];
    }

    public function data(): array
    {
        return [
            'title'       => $this->title,
            'description' => $this->description,
            'criteria'    => $this->criteria,
            'candidate'   => $this->candidate,
            'row'         => $this->row,
            'pairwise'    => $this->pairwise,
            'type'        => $this->type,
        ];
    }
}
