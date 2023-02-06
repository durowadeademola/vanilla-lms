<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Course;

class CreateCourseRequest extends AppBaseFormRequest
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
        //return Course::$rules;

        return [
            'code' => "required|max:191|unique:courses,code",
            'name' => "required|max:191",
            'description' => 'required',
            'credit_hours' => 'required|gte:0',
            'level' => 'required'
        ];
    }

    public function attributes(){
       return ['credit_hours' => 'course load'];
    }
}
