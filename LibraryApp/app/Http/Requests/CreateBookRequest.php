<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'release_date' => ['required', 'integer', 'between:0,' . now()->year,],
            'authors' => ['required', 'array'],
            'authors.*' => ['integer', 'distinct', 'exists:authors,id'],
            'status' => ['boolean']
        ];
    }
}
