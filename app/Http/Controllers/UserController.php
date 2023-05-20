<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use DB;

Class UserController extends Controller {
    use ApiResponser;
    
    private $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    // show all records (unsecure routes)
    public function getUsers()
    {
        // $users = User::all();
        $users = DB::connection('mysql')
        ->select("Select * from customer");

        // return response()->json($users, 200);
        return $this->successResponse($users);
    }
    
    // show all records
    public function index()
    {

        $users = User::all();

        return $this->successResponse($users);
    }

    // add records
    public function add(Request $request)
    {
        $rules = [
            'student_name' => 'required|max:50',
            'student_age' => 'required|max:10',
            'student_sex' => 'required|in:Male,Female',
        ];

        $this->validate($request,$rules);

        $user = User::create($request->all());

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    // delete records
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $this->successResponse($user);


        //return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
        
    }

    // update records
    public function update(Request $request,$id)
    {
        $rules = [
            'student_name' => 'required|max:50',
            'student_age' => 'required|max:10',
            'student_sex' => 'required|in:Male,Female',
        ]; 
        $this->validate($request, $rules);
        $user = User;;findOrFail($id);
        $user->fill($request->all());

        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->successResponse($user);
    }

    // show records
    public function show($id)
    {

        $user = User::findOrFail($id);
        return $this->successResponse($user);

        /*
        $user = User::where('customer_id', $id)->first();
        if($user){
            return $this->successResponse($user);
        }
        {
        return $this->errorResponse('user ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }
        }
        */

    }

} 