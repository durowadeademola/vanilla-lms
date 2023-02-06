<?php

namespace App\Http\Requests\API;

use App\Models\CalendarEntry;
use InfyOm\Generator\Request\APIRequest;
use App\Http\Requests\AppBaseFormRequest;

class UpdateCalendarEntryAPIRequest extends AppBaseFormRequest
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
        $rules = CalendarEntry::$rules;
        
        return $rules;
        */
        return [
            'id' => 'required|numeric|exists:calendar_entries,id',
            'due_date' => 'required_without:course_class_id|date|after_or_equal:today',
            'title' => 'required',
            'description' => 'required',
            'due_day' => 'required_with:course_class_id',
            'due_time' => 'required_with:course_class_id|date_format:h:i A'
        ];
    }
    public  function messages(){

        return [
            'due_day.required_with' => 'The day field is required',
            'due_time.required_with' => 'The time field is required',
            'due_date.required_without' => 'The :attribute field is required'
        ];
    }
    public function calendarentry_exist(){
        return CalendarEntry::where('title', $this->title)->where('due_date', $this->due_date)->where('description', $this->description)->where('id','<>', $this->id)->get();
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (count($this->calendarentry_exist()) != 0) {
                $validator->errors()->add('announcement_exist', 'Calendar Already Exist');
            }
        });
    }
}
