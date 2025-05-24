<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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
            'Name_Section_Ar'     => 'required|string|max:255|unique:sections,section_name->ar,' . $this->id . ',id,classroom_id,' . $this->input('classroom_id'),
            'Name_Section_En'     => 'required|string|max:255|unique:sections,section_name->en,' . $this->id . ',id,classroom_id,' . $this->input('classroom_id'),
            'stage_id'            => 'required|exists:stages,id',
            'classroom_id'        => 'required|exists:classrooms,id',
        ];
    }


    public function messages()
    {
        return [
            'Name_Section_Ar.required'  => trans('validation.required'),
            'Name_Section_Ar.string'    => trans('validation.string'),
            'Name_Section_Ar.max'       => trans('validation.max'),
            'Name_Section_Ar.unique'    =>trans('validation.unique') ,

            'Name_Section_En.required'  => trans('validation.required'),
            'Name_Section_En.string'    => trans('validation.string'),
            'Name_Section_En.max'       => trans('validation.max'),
            'Name_Section_En.unique'    =>trans('validation.unique') ,

            'stage_id.required'         =>  trans('validation.required'),
            'stage_id.exists'           =>  trans('validation.exists'),

            'classroom_id.required'      =>  trans('validation.required'),
            'classroom_id.exists'        =>  trans('validation.exists'),
        ];
    }
}

//! section_name : unique for classroom_id
/* 
Rule::unique('sections', 'section_name->ar')->where(function ($query) {
    return $query->where('classroom_id', $this->input('classroom_id')); // classroom_id = القيمة المرسلة مع الطلب
}),

OR :       unique:table,column,except,idColumn,extraWhere. 

To check for duplicate data during an update so that the current record is excluded, :  .$this->id
'Name_Section_Ar'   => 'required|string|max:255|unique:sections,section_name->ar,' . $this->id . ',id,classroom_id,' . $this->input('classroom_id'),
*/