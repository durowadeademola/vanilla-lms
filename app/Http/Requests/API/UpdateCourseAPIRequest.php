<?php

namespace App\Http\Requests\API;

use App\Models\Course;
use InfyOm\Generator\Request\APIRequest;
use App\Http\Requests\AppBaseFormRequest;

class UpdateCourseAPIRequest extends AppBaseFormRequest
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
        $rules = Course::$rules;
        
        return $rules;
        */
        return [
            'id' => 'required|numeric|exists:courses,id',
            'code' => 'required',
            'name' => 'required',
            'credit_hours' => 'required|gte:0',
            'level' => 'required'
        ];
    }
    
    public function attributes(){
        return ['credit_hours' => 'course load'];
     }
}
