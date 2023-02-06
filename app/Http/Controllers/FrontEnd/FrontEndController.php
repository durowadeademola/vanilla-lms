<?php

namespace App\Http\Controllers\FrontEnd;


use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\CreateLecturerRequest;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

use App\Models\User;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Department;
use App\Models\Level;

use App\Events\StudentCreated;
use App\Events\LecturerCreated;
use App\Repositories\StudentRepository;
use App\Repositories\LecturerRepository;

use Illuminate\Http\Request;

class FrontEndController extends AppBaseController
{

    /** @var  StudentRepository */
    private $studentRepository;

    /** @var  LecturerRepository */
    private $lecturerRepository;

    public function __construct(LecturerRepository $lecturerRepo, StudentRepository $studentRepo)
    {
        $this->middleware('guest');
        $this->lecturerRepository = $lecturerRepo;
        $this->studentRepository = $studentRepo;

        parent::__construct();
    }

    /**
     * Show the frontend home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $current_user = Auth()->user();
        if($request->has('code') && $request->has('state')){
         
            return redirect()->route('bims.login',['code' => $request->get('code'),'state' => $request->get('state')]);
            
        }
        
        return view('welcome');
    }

    /**
     * Show the student registration page.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayStudentRegistration(Request $request)
    {
        if (isset($this->app_settings['cbx_allow_student_registration'])==false || $this->app_settings['cbx_allow_student_registration']!=1) {
            return abort(404);
        }

        $departmentItems = \App\Models\Department::where('parent_id','!=', null)
                                                ->where('is_parent', false)
                                                ->pluck('name','id')->toArray();
        $levels = Level::all();

        return view('student-register')
                ->with("departmentItems", $departmentItems)
                ->with('levels', $levels);
                
    }


    /**
     * Show the lecturer registration page.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayLecturerRegistration(Request $request)
    {
        if (isset($this->app_settings['cbx_allow_lecturer_registration'])==false || $this->app_settings['cbx_allow_lecturer_registration']!=1) {
            return abort(404);
        }

        $departmentItems = \App\Models\Department::where('parent_id','!=', null)
                                                ->where('is_parent', false)
                                                ->pluck('name','id')->toArray();

        return view('lecturer-register')
                ->with("departmentItems", $departmentItems);

    }


    /**
     * Process the lecturer registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function processLecturerRegistration(CreateLecturerRequest $request)
    {
        if (isset($this->app_settings['cbx_allow_lecturer_registration'])==false || $this->app_settings['cbx_allow_lecturer_registration']!=1) {
            return abort(404);
        }

        $input = $request->all();
        $lecturer = $this->lecturerRepository->create($input);
        LecturerCreated::dispatch($lecturer);

        return redirect()->route('login')->with('success','You have been successfully registered. Please check your email for your login credentials to access the portal.');
    }

    /**
     * Process the student registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function processStudentRegistration(CreateStudentRequest $request)
    {
        if (isset($this->app_settings['cbx_allow_student_registration'])==false || $this->app_settings['cbx_allow_student_registration']!=1) {
            return abort(404);
        }

        $input = $request->all();
        $student = $this->studentRepository->create($input);
        StudentCreated::dispatch($student);

        return redirect()->route('login')->with('success','You have been successfully registered. Please check your email for your login credentials to access the portal.');
    }



}
