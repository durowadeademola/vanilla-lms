<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Submission;

class UpdateSubmissionRequest extends AppBaseFormRequest
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
        $rules = Submission::$rules;
        
        return $rules;
        */

        return [
            'id' => 'required|numeric|exists:submissions,id',
            'title' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,ppt,xlsx,xls'
        ];
    }
}
