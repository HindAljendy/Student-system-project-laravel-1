<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
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
    
     * The 'List_classes.*   :  here indicates that the check applies to every element in the List_Classes array
     */
    public function rules(): array
    {
        return [
            'List_classes'                 => 'required|array|min:1',
            'List_classes.*.name_class_en' => 'required|string|max:255',
            'List_classes.*.name_class_ar' => 'required|string|max:255',
            'List_classes.*.stage_id'      => 'required|exists:stages,id',
        ];
    }

     public function messages()
    {
        return [
        'List_classes.required'                 => trans('validation.required'),
        'List_classes.array'                    => trans('validation.array'),
        'List_classes.min'                      => trans('validation.min'),

        'List_classes.*.name_class_en.required' => trans('validation.required') ,
        'List_classes.*.name_class_en.string'   => trans('validation.string'),
        'List_classes.*.name_class_en.max'      => trans('validation.max'),
        'List_classes.*.name_class_ar.required' => trans('validation.required') ,
        'List_classes.*.name_class_ar.string'   => trans('validation.string'),
        'List_classes.*.name_class_ar.max'      =>  trans('validation.max'),

        'List_classes.*.stage_id.required'      =>  trans('validation.required'),
        'List_classes.*.stage_id.exists'        =>  trans('validation.exists'),
        ];
    }
}

