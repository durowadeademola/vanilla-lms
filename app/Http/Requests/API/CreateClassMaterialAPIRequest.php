<?php

namespace App\Http\Requests\API;

use App\Models\ClassMaterial;
use InfyOm\Generator\Request\APIRequest;
use App\Http\Requests\AppBaseFormRequest;


class CreateClassMaterialAPIRequest extends AppBaseFormRequest
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
        //return ClassMaterial::$rules;

        return [
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'examination_number' => 'required_if:type,class-examinations',
            'assignment_number' => 'required_if:type,class-assignments',
            'due_date' => 'required_if:type,class-assignments',
            'lecture_number' => 'required_if:type,lecture-classes',
            'reference_material_url' => 'nullable|url',
            'grade_max_points' => 'nullable|numeric|min:0|max:100',
            'grade_contribution_pct' => 'nullable|numeric|min:0|max:100',
            'grade_contribution_notes' => 'nullable|string|max:300',
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
            'title' => 'Title',
            'description' => 'Description',
            'lecture_number' => 'Lecture Number',
            'examination_number' => 'Examination Number',
            'reference_material_url' => 'Reference Material URL',
            'grade_max_points' => 'Maximum Points towards Grade',
            'grade_contribution_pct' => 'Percent Contribution to Grade',
            'grade_contribution_notes' => 'Grade Notes',
        ];
    }
    
}
