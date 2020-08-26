<?php

declare (strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'name'   => ['required', 'string', 'min:3'],
            'nis'    => ['required', 'string'],
            'gender' => ['required', 'integer'],
        ];
    }

    /**
     * Get the data from incoming request
     *
     * @return array
     */
    public function data(): array
    {
        return [
            'name'   => $this->name,
            'nis'    => $this->nis,
            'gender' => $this->gender,
        ];
    }
}