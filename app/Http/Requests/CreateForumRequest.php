<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Forum;

class CreateForumRequest extends AppBaseFormRequest
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
        //return Forum::$rules;

        return [
            'group_name' => 'required',
            'posting' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
        ];
    }

    public function attributes()
    {
        return [
            'group_name' => 'Name',
            'posting' => 'Description',
        ];
    }
}
