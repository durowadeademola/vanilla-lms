<?php

namespace App\Http\Controllers\API;

use App\Events\StudentCreated;
use App\Events\StudentUpdated;
use App\Events\StudentDeleted;

use Illuminate\Support\Facades\Http;
use App\Http\Requests\API\CreateStudentAPIRequest;
use App\Http\Requests\API\UpdateStudentAPIRequest;
use App\Http\Requests\API\BulkStudentApiRequest;
use App\Http\Requests\API\ChangeStudentStatusAPIRequest;
use App\Http\Requests\UpdateUserPasswordResetRequest;
use App\Models\Student;
use App\Models\User;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\StudentResource;
use Response;


/**
 * Class StudentController
 * @package App\Http\Controllers\API
 */

class StudentAPIController extends AppBaseController
{
    /** @var  StudentRepository */
    private $studentRepository;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepository = $studentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/students",
     *      summary="Get a listing of the Students.",
     *      tags={"Student"},
     *      description="Get all Students",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Student")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $students = $this->studentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StudentResource::collection($students), 'Students retrieved successfully');
    }

    /**
     * @param CreateStudentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/students",
     *      summary="Store a newly created Student in storage",
     *      tags={"Student"},
     *      description="Store Student",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Student that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Student")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Student"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStudentAPIRequest $request)
    {
        $input = $request->all();

        $student = $this->studentRepository->create($input);
        
        StudentCreated::dispatch($student);
        return $this->sendResponse(new StudentResource($student), 'Student saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/students/{id}",
     *      summary="Display the specified Student",
     *      tags={"Student"},
     *      description="Get Student",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Student",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Student"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Student $student */
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        return $this->sendResponse(new StudentResource($student), 'Student retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStudentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/students/{id}",
     *      summary="Update the specified Student in storage",
     *      tags={"Student"},
     *      description="Update Student",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Student",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Student that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Student")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Student"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStudentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Student $student */
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        $student = $this->studentRepository->update($input, $id);
        
        StudentUpdated::dispatch($student);
        return $this->sendResponse(new StudentResource($student), 'Student updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/students/{id}",
     *      summary="Remove the specified Student from storage",
     *      tags={"Student"},
     *      description="Delete Student",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Student",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Student $student */
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        $student->delete();
        StudentDeleted::dispatch($student);
        return $this->sendSuccess('Student deleted successfully');
    }

    public function uploadBulkStudents(BulkStudentApiRequest $request)
    {
        $extension = $request->file('bulk_student_file')->getClientOriginalExtension();
        $attachedFileName = time() . '.' . $extension;
        $request->file('bulk_student_file')->move(public_path('uploads'), $attachedFileName);
        $path_to_file = public_path('uploads').'/'.$attachedFileName;

        $errors = [];
        $loop = 1;
        $lines = file($path_to_file);
        if (count($lines) > 1) {
            foreach ($lines as $line) {
                // skip first line (heading line)
                if ($loop > 1) {
                    $data = explode(',', $line);
                    // dd($data);
                    $invalids = $this->validateValues($data);
                  if (count($invalids) > 0) {
                    array_push($errors, $invalids);
                    continue;
                  }else{
                    $bims_data = [
                        'client_id' => env('BIMS_CLIENT_ID'),
                        'first_name' => trim($data[1]),
                        'last_name' => trim($data[2]),
                        'email' => trim($data[0]),
                        'phone' => trim($data[4]),
                        'gender' => "M"
                    ];
                    if (trim($data[3]) == 'Male') {
                        $bims_data['gender'] = "M";
                    } else {
                        $bims_data['gender'] = "F";
                    }       
                    $register_for_bims = Http::acceptJson()->post(env('BIMS_CREATE_USER_URL'),  $bims_data);
                    
                    $ext_student_data =  [
                        'email' => trim($data[0]),
                        'first_name' => trim($data[1]),
                        'last_name' => trim($data[2]),
                        'telephone' => trim($data[4]),
                        'sex' => trim($data[3]),
                        'matriculation_number' => trim($data[5]),
                        'level' => trim($data[6]),
                    ];
                    if(strtolower(trim($data[3])) == 'm' || strtolower(trim($data[3])) == 'male'){
                        $ext_student_data['sex'] = "Male";
                    }elseif(strtolower(trim($data[3])) == 'f' || strtolower(trim($data[3])) == 'female'){
                        $ext_student_data['sex'] = "Female";
                    }
                    $student_data = array_merge($request->input(), $ext_student_data);     
                    $student = Student::create($student_data); 
                    StudentCreated::dispatch($student);
                  }
                }else{
                    $headers = explode(',', $line);
                    if (count($headers) != 7 || strtolower(trim($headers[0])) != 'email' || strtolower(trim($headers[1])) != 'first name' || strtolower(trim($headers[2])) != 'last name'  || strtolower(trim($headers[3])) != 'sex'  || strtolower(trim($headers['4'])) != 'telephone' || trim(strtolower($headers[5]) != 'matric no') || trim(strtolower($headers[6]), "\r\n") != 'level') {
                        $invalids['inc'] = 'The file format is incorrect. Must be - "Email,First Name,Last Name,Sex,Telephone,Matric no,Level"';
                        array_push($errors, $invalids);
                        break;
                    }
                }
                $loop++;
            }   
        }else{
            $errors[] = 'The uploaded csv file is empty';
        }

        if (count($errors) > 0) {
            return response()->json(['errors' => $this->array_flatten($errors)]);
        }
        return true;
    }

    public function validateValues($data)
    {
        $errors = [];

        // validte email
        if (!filter_var(trim($data[0]), FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'The email: '.trim($data[0]).' is invalid';
        }

        // validate email uniqueness
        $student = Student::where('email', trim($data[0]))->first();
        if ($student) {
            $errors[] = 'The email: '.trim($data[0]).' already belongs to a student';
        }

        $user = User::where('email', trim($data[0]))->first();
        if ($user) {
            $errors[] = 'The email: '.trim($data[0]).' already belongs to a user';
        }

        // validate matric number
        $student = Student::where('matriculation_number', trim($data[5]))->first();
        if ($student) {
            $errors[] = 'The matriculation number: '.trim($data[5]).' already belongs to a student';
        }

        // validate phone number
        $student = Student::where('telephone', trim($data[4]))->first();
        if ($student) {
            $errors[] = 'The telephone number: '.trim($data[4]).' already belongs to a student';
        }

        $user = User::where('telephone', trim($data[4]))->first();
        if ($user) {
            $errors[] = 'The telephone number: '.trim($data[4]).' already belongs to a user';
        }
        return $errors;
    }

    public function array_flatten($array) {

       $return = array();
       foreach ($array as $key => $value) {
           if (is_array($value)){ $return = array_merge($return, $this->array_flatten($value));}
           else {$return[$key] = $value;}
       }
       return $return;
    }

    public function resetStudentPassword(UpdateUserPasswordResetRequest $request)
    {
        $student = Student::find($request->id);
        if (!$student) {
            return response()->json(['errors'=>['not found'=>'Student not found']]);
        }
        $user = $student->user;
        $user->password = \Hash::make($request->password);
        $user->save();

        return true;
    }

    public function changeStudentStatus(ChangeStudentStatusAPIRequest $request){
        $student = Student::find($request->id);
        if (!$student) {
            return response()->json(['errors'=>['not found'=>'Student not found']]);
        }
        $student->level = $request->level;
        $student->has_graduated = false;
        $student->save();
        $user = $student->user;
        $user->is_disabled = false;
        $user->save();

        return $this->sendResponse(new StudentResource($student), 'Student status updated successfully');
    }
}
