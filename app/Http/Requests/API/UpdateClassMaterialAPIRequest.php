<?php

namespace App\Http\Requests\API;

use App\Models\ClassMaterial;
use InfyOm\Generator\Request\APIRequest;
use App\Http\Requests\AppBaseFormRequest;

class UpdateClassMaterialAPIRequest extends AppBaseFormRequest
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
     * @return array
     */
    public function rules()
    {
        /*
        $rules = ClassMaterial::$rules;
        
        return $rules;
        */

        return [
            'id' => "required|numeric|exists:class_materials,id",
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'examination_number' => 'required_if:type,class-examinations',
            'assignment_number' => 'required_if:type,class-assignments',
            'due_date' => 'required_if:type,class-assignments',
            'lecture_number' => 'required_if:type,lecture-classes',
            'reference_material_url' => 'nullable|url',
            'exam_time' => 'required_if:type,class-examinations|date_format:h:i A',
            'exam_date' => 'required_if:type,class-examinations|date|after:today',
        ];
    }

    public function messages()
    {
        return [
            'lecture_number.required_if' => 'The :attribute field is required.',
            'assignment_number.required_if' => 'The :attribute field is required.',
            'examination_number.required_if' => 'The :attribute field is required.',
            'due_date.required_if' => 'The :attribute field is required.',
            'reference_material_url.url' => 'The :attribute Must Start with http://'
        ];
    }

    public function attributes()
    {
        return [
            'lecture_number' => 'Lecture Number',
            'title' => 'Title',
            'description' => 'Description',
            'reference_material_url' => 'Reference Material URL'
        ];
    }
}
