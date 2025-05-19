<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditClassroomRequest extends FormRequest
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
            'name_class_ar' =>'required|string|max:255',
            'name_class_en' =>'required|string|max:255',
            'stage_id'      =>  'required|exists:stages,id',
        ];
    }

    public function messages()
    {
        return [
        'name_class_ar.required' =>  trans('validation.required'),
        'name_class_ar.string'   =>  trans('validation.string'),
        'name_class_ar.max'      =>  trans('validation.max'),
        'name_class_en.string'   =>  trans('validation.string'),
        'name_class_en.max'      =>  trans('validation.max'),
        'name_class_en.required' =>  trans('validation.required'),
        'stage_id.required'      =>  trans('validation.required'),
        'stage_id.exists'        =>  trans('validation.exists'),

        ];
        

    } 
}
