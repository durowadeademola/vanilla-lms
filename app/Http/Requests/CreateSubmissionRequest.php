<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Submission;

class CreateSubmissionRequest extends AppBaseFormRequest
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
        //return Submission::$rules;

        return [
            'file' => 'required|mimes:pdf,doc,docx,ppt,xlsx,xls'
        ];
    }

    public function attributes()
    {
        return [
            'file' => 'Assignment File',

        ];
    }
}
