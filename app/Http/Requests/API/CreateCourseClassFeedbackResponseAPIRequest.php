<?php

namespace App\Http\Requests\API;

use App\Models\CourseClassFeedbackResponse;
use InfyOm\Generator\Request\APIRequest;
use App\Http\Requests\AppBaseFormRequest;


class CreateCourseClassFeedbackResponseAPIRequest extends AppBaseFormRequest
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
        
        return [
            'assignments_rating_point' => 'required',
            'clarification_rating_point' => 'required',
            'examination_rating_point' => 'required',
            'teaching_rating_point' => 'required'
        ];
    }

}
