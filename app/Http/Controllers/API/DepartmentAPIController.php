<?php

namespace App\Http\Controllers\API;

use App\Events\DepartmentCreated;
use App\Events\DepartmentUpdated;
use App\Events\DepartmentDeleted;

use App\Http\Requests\API\CreateDepartmentAPIRequest;
use App\Http\Requests\API\UpdateDepartmentAPIRequest;
use App\Http\Requests\API\BulkDepartmentApiRequest;
use App\Models\Department;
use App\Repositories\DepartmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\DepartmentResource;
use Response;

/**
 * Class DepartmentController
 * @package App\Http\Controllers\API
 */

class DepartmentAPIController extends AppBaseController
{
    /** @var  DepartmentRepository */
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepository = $departmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/departments",
     *      summary="Get a listing of the Departments.",
     *      tags={"Department"},
     *      description="Get all Departments",
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
     *                  @SWG\Items(ref="#/definitions/Department")
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

        $departments = Department::where('parent_id', '!=', null)
                                ->where('is_parent', false)->all(
                                    $request->except(['skip', 'limit']),
                                    $request->get('skip'),
                                    $request->get('limit')
                                );

        return $this->sendResponse(DepartmentResource::collection($departments), 'Departments retrieved successfully');
    }

    /**
     * @param CreateDepartmentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/departments",
     *      summary="Store a newly created Department in storage",
     *      tags={"Department"},
     *      description="Store Department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Department that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Department")
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
     *                  ref="#/definitions/Department"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDepartmentAPIRequest $request)
    {
        $is_parent = false;

        $input = array_merge(['is_parent' => $is_parent], $request->all());

        $department = Department::create($input);
        
        DepartmentCreated::dispatch($department);
        return $this->sendResponse(new DepartmentResource($department), 'Department saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/departments/{id}",
     *      summary="Display the specified Department",
     *      tags={"Department"},
     *      description="Get Department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Department",
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
     *                  ref="#/definitions/Department"
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
        $department = Department::where('parent_id', '!=', null)
                                 ->where('is_parent', false)
                                 ->find($id);

        if (empty($department)) {
            return $this->sendError('Department not found');
        }

        return $this->sendResponse(new DepartmentResource($department), 'Department retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDepartmentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/departments/{id}",
     *      summary="Update the specified Department in storage",
     *      tags={"Department"},
     *      description="Update Department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Department",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Department that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Department")
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
     *                  ref="#/definitions/Department"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDepartmentAPIRequest $request)
    {
        $department = Department::where('parent_id', '!=', null)
                                 ->where('is_parent', false)
                                 ->find($id);

        if (empty($department)) {
            return $this->sendError('Department not found');
        }

       $department->update($request->all());
        
        DepartmentUpdated::dispatch($department);
        return $this->sendResponse(new DepartmentResource($department), 'Department updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/departments/{id}",
     *      summary="Remove the specified Department from storage",
     *      tags={"Department"},
     *      description="Delete Department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Department",
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
        $department = Department::where('parent_id', '!=', null)
                                 ->where('is_parent', false)
                                 ->find($id);

        if (empty($department)) {
            return $this->sendError('Department not found');
        }

        $department->delete();
        DepartmentDeleted::dispatch($department);
        return $this->sendSuccess('Department deleted successfully');
    }

    public function uploadBulkDepartment(BulkDepartmentApiRequest $request)
    {
        $extension = $request->file('bulk_department_file')->getClientOriginalExtension();
        $attachedFileName = time() . '.' . $extension;
        $request->file('bulk_department_file')->move(public_path('uploads'), $attachedFileName);
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
                    $dept_data = array_merge($request->input(), [
                    'code' => trim($data[0]),
                    'name' => trim($data[1])
                  ]);     
                    $dept = Department::create($dept_data); 
                    DepartmentCreated::dispatch($dept);
                  }
                }else{
                    $headers = explode(',', $line);
                    if (count($headers) != 2 || strtolower(trim($headers[0])) != 'code' || strtolower(trim($headers[1])) != 'name' || isset($headers[2])) {
                        $invalids['inc'] = 'The file format is incorrect. Must be - "code,name"';
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

        $department = Department::where('is_parent',false)->where('parent_id', '!=', null)->where('code', trim($data[0]))->first();
        if ($department) {
            $errors[] = 'The code: '.trim($data[0]).' already belongs to a department';
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
}
