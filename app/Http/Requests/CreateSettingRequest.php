<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Setting;

class CreateSettingRequest extends AppBaseFormRequest
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
        //return Setting::$rules;

        return [
            'key' => 'required',
            'value' => 'nullable',
            'group_name' => 'nullable',
            'model_type' => 'nullable',
            'model_value' => 'nullable'
        ];
    }
}
