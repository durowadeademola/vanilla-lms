<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

/**
 * @SWG\Definition(
 *      definition="ClassMaterial",
 *      required={"type", "title"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="lecture_number",
 *          description="lecture_number",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="assignment_number",
 *          description="assignment_number",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="due_date",
 *          description="due_date",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="blackboard_meeting_id",
 *          description="blackboard_meeting_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="blackboard_meeting_status",
 *          description="blackboard_meeting_status",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="upload_file_path",
 *          description="upload_file_path",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="upload_file_type",
 *          description="upload_file_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="reference_material_url",
 *          description="reference_material_url",
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
 *      )
 * )
 */
class ClassMaterial extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Notifiable;

    public $table = 'class_materials';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'title',
        'description',
        'lecture_number',
        'assignment_number',
        'due_date',
        'due_time',
        'upload_file_path',
        'upload_file_type',
        'reference_material_url',
        'allow_late_submission',
        'course_class_id',
        'grade_max_points',
        'grade_contribution_pct',
        'grade_contribution_notes',
        'examination_number',
        'blackboard_meeting_id',
        'blackboard_meeting_status',
        'semester_id',
        'department_id',
        'lecture_date',
        'lecture_time',
        'lecture_end_time',
        'exam_date',
        'exam_time',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'title' => 'string',
        'due_time' => 'datetime',
        'description' => 'string',
        'lecture_number' => 'integer',
        'assignment_number' => 'integer',
        'blackboard_meeting_id' => 'string',
        'blackboard_meeting_status' => 'string',
        'upload_file_path' => 'string',
        'upload_file_type' => 'string',
        'reference_material_url' => 'string',
        'course_class_id' => 'integer',
        'grade_max_points' => 'integer',
        'grade_contribution_pct' => 'integer',
        'grade_contribution_notes' => 'string',
        'examination_number' => 'integer',
        'lecture_date' => 'datetime',
        'lecture_time' => 'datetime',
        'lecture_end_time' => 'datetime',
        'exam_date' => 'datetime',
        'exam_time' => 'datetime',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function courseClass()
    {
        return $this->hasOne(CourseClass::class, 'id', 'course_id');
    }

    public function department()
    {
       return $this->hasOne(Department::class, 'id', 'department_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function submissions()
    {
        return $this->hasMany(Submission::class, 'class_material_id', 'id');
    }
    public function grades()
    {
        return $this->hasMany(Grade::class, 'class_material_id', 'id');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = (new \Carbon\Carbon($value))->format('y/m/d');
    }

    public function attendance()
    {
        return $this->hasMany(StudentAttendance::class);
    }
}
