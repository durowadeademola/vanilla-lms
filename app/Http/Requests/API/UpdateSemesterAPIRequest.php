<?php

namespace App\Http\Requests\API;

use App\Models\Semester;
use InfyOm\Generator\Request\APIRequest;
use App\Http\Requests\AppBaseFormRequest;

class UpdateSemesterAPIRequest extends AppBaseFormRequest
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
        $rules = Semester::$rules;
        
        return $rules;
        */
        return [
            'id' => 'required|numeric|exists:semesters,id',
            'code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }
}
