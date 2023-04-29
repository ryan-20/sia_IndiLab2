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

    public function getUsers(){
        // $users = User::all();
        $users = DB::connection('mysql')
        ->select("Select * from customer");

        // return response()->json($users, 200);
        return $this->successResponse($users);
    }
    
    public function index(){

        $users = User::all();

        return $this->successResponse($users);
    }


    public function add(Request $request){
        $rules = [
            'customer_name' => 'required|max:20',
            'customer_age' => 'required|max:3',
            'customer_sex' => 'required|max:1',
        ];

        $this->validate($request,$rules);

        $user = User::create($request->all());

        return $this->successResponse($user, Response::HTTP_CREATED);
    }
}