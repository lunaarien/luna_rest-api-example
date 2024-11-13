<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Machine;
use App\Models\ManufacturingAddress;

class APIController extends Controller
{

    //User::all() to retrieves all users when no name is provided.
    //User::where('name', $name)->first() retrieves the first user with the specified name.
    //User::find() only works with id and cannot be used to search by other columns. 

    public function getUsers($id = null)
    {
        if (empty($id)) {
            $users = User::get();
            return response()->json([['users'=>$users]],200);
        } else {    
            $users = User::find($id);
            return response()->json([['users'=>$users]],200);

        }
    }  

    public function getNameUsers($id = null)
    {
        if (empty($id)) {
            $users = User::select('name')->get();
            return response()->json([['users'=>$users]],200);
        } else {    
            $users = User::select('name')->find($id);
            return response()->json([['users'=>$users]],200);

        }
    }  

    public function getMultipleColumnUsers($id = null)
    {
        if (empty($id)) {
            $users = User::select('name', 'email')->get();
            return response()->json([['users'=>$users]],200);
        } else {    
            $users = User::select('name', 'email')->find($id);
            return response()->json([['users'=>$users]],200);

        }
    }  


    public function addUsers(Request $request)
    {
        if ($request->isMethod('post')) {
            $userData = $request->input();
            /*echo "<pre>"; print_r($userData); die;*/

            //Post API Validation to check user details
            if (empty($userData['name']) ||empty($userData['email']) ||empty($userData['password'])
                ){
                    $error_message = "Please enter your complete user details!";
                }

            //Check if email is valid
            if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)){
                $error_message = "Please enter valid Email!";
            }

            //Check if User Email Already Exists
            $userCount = User::where("email",$userData["email"])->count();
            if ($userCount>0) {
                $error_message = "Email already exists!";
            }

            //Error Message
            if(isset($error_message)&&!empty($error_message)){
                return response()->json(["Status"=>false,"message"=>$error_message],422);
            }

            // $rules = [
            //     'name'=> "required",
            //     'email'=> "required|email|unique:users",
            //     'password'=> "required",
            // ];

            // $cutomMessages = [
            //     'name.required'=> 'Name is required',
            //     'email.required' => 'Email is required',
            //     'email.email' => 'Valid Email is required',
            //     'email.unique' => 'Email is already exists in database',
            //     'password.required' => 'Password is required',
            // ];
            // $validator = Validator::make($userData, $rules, $cutomMessages);

            // if($validator->fails()){
            //     return response()->json([$validator
            // }

            
            $user = new User;
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->password = bcrypt($userData['password']);
            $user->save();
            return response()->json(['message'=>['User added successfully!']]);
        }
    }

    
}
