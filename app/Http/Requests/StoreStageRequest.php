<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStageRequest extends FormRequest
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
            'name_stage_en'  => 'required|string |max:255 |unique:stages,name->en,'.$this->id,
            'name_stage_ar'  => 'required|string |max:255 |unique:stages,name->ar,'.$this->id,
            'notes_stage_en' => 'required|string |max:255',
            'notes_stage_ar' => 'required|string |max:255',
        ];
    }

    public function messages()
    {
        return [
            'name_stage_en.required'  => trans('validation.required'),
            'name_stage_en.string'    => trans('validation.string'),
            'name_stage_en.max'       => trans('validation.max'),
            'name_stage_en.unique'    =>trans('validation.unique') ,

            'name_stage_ar.required'  => trans('validation.required'),
            'name_stage_ar.string'    => trans('validation.string'),
            'name_stage_ar.max'       => trans('validation.max'),
            'name_stage_ar.unique'    =>trans('validation.unique') ,

            'notes_stage_en.required' =>trans('validation.required') ,
            'notes_stage_en.string'   =>trans('validation.string') ,
            'notes_stage_en.max'      =>trans('validation.max') ,

            'notes_stage_ar.required' =>trans('validation.required') ,
            'notes_stage_ar.string'   =>trans('validation.string') ,
            'notes_stage_ar.max'      =>trans('validation.max') ,
        ];
    }
}

//! 'name_stage_en' => 'required|unique:stages,name->en,'.$this->id 
//? name : {"en":"Secondary stage","ar":"المرحلة الثانوية"}
/* 
Ensures that the input name (in both Arabic and English) is unique within the `stages` table.
Crucially, the current record (identified by `$this->id`) is excluded from this uniqueness check.

This is essential for updating existing records.  
If you're attempting to add a new record, Laravel will check for the name's existence in the `stages` table. 
If a matching name already exists, it will return an error. 
However, if you're updating an existing record, the current record (`$this->id`) is exempt from the uniqueness check, allowing you to update the name without triggering a duplicate error.
In short, `$this->id` acts as an exception to the uniqueness rule, specifically for the record being updated.

When sending an update request with the same information, without modifying any of it, no error will appear indicating that the record already exists in the database.
However, when editing data similar to the database, an error will appear stating that duplicate field values ​​are not allowed.

*/
//! another way :
/*  package : laravel_unique_translation   spatie : https://github.com/codezero-be/laravel-unique-translation

Validate an Array of Translations
Your form can also submit an array of slugs.

<input name="slug[en]">
<input name="slug[ar]">
We need to validate the entire array in this case.   Mind the slug.* key.

$attributes = request()->validate([
    'slug.*' => 'unique_translation:stages',
    / or...
    'slug.*' => UniqueTranslationRule::for('stages'),
]);

*/
//! another way : 
/* if with Query  exists :
if(Stage::where(name->ar , $request->name_stage_ar)->orWhere(name->en , name_stage_en)->exists()){
 return redirect()->back()->withErrors(trans('messages.error'));
}




*/