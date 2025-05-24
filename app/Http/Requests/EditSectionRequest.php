<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Name_Section_Ar'     => 'nullable|string|max:255|unique:sections,section_name->ar,' . $this->id . ',id,classroom_id,' . $this->input('classroom_id'),
            'Name_Section_En'     => 'nullable|string|max:255|unique:sections,section_name->en,' . $this->id . ',id,classroom_id,' . $this->input('classroom_id'),
            'stage_id'            => 'nullable|exists:stages,id',
            'classroom_id'        => 'nullable|exists:classrooms,id',
        ];
    }
}
