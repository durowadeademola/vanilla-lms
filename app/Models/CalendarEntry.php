<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="CalendarEntry",
 *      required={"title"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="due_date",
 *          description="due_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="course_class_id",
 *          description="course_class_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="department_id",
 *          description="department_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class CalendarEntry extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'calendar_entries';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'due_date',
        'due_day',
        'due_time',
        'description',
        'course_class_id',
        'department_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'due_date' => 'date',
        'due_day' => 'string',
        'due_time' => 'datetime',
        'description' => 'string',
        'course_class_id' => 'integer',
        'department_id' => 'integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function courseClass()
    {
        return $this->hasOne(\App\Models\CourseClass::class, 'id', 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function department()
    {
        return $this->hasOne(\App\Models\Department::class, 'id', 'department_id');
    }
}
