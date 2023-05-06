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

    // add of records
    public function add(Request $request)
    {
        $rules = [
            'customer_name' => 'required|max:20',
            'customer_age' => 'required|max:3',
            'customer_sex' => 'required|in:M,F',
            'customer_id' => 'required|max:2',
        ];

        $this->validate($request,$rules);

        $user = User::create($request->all());

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    // delete of records
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $this->successResponse($user);
    }

    // update of records
    public function update(Request $request,$id)
    {
        $rules = [
            'customer_name' => 'required|max:20',
            'customer_age' => 'required|max:3',
            'customer_sex' => 'required|max:1',
            'customer_id' => 'required|max:2',
        ]; 
        $this->validate($request, $rules);
        $user = User;;findOrFail($id);
        $user->fill($request->all()); 
    }

    // show records
    public function show($id)
    {
    $user = User::where('customer_id', $id)->first();
    if($user){
        return $this->successResponse($user);
    }
    {
    return $this->errorResponse('user ID Does Not Exists', Response::HTTP_NOT_FOUND);
    }
    }

}