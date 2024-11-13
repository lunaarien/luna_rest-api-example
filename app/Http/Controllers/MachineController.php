<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\ManufacturingAddress;


class MachineController extends Controller
{


    
    public function getMachine($id = null)
    {
        if (empty($id)) {
            $machines = Machine::get();
            return response()->json([['machines'=>$machines]],200);
        } else {    
            $machines = Machine::find($id);
            return response()->json([['machines'=>$machines]],200);

        }
    }  

    public function getMachineName($id = null)
    {
        if (empty($id)) {
            $machines = Machine::select('machine_name')->get();
            return response()->json([['machines'=>$machines]],200);
        } else {    
            $machines = Machine::select('machine_name')->find($id);
            return response()->json([['machines'=>$machines]],200);

        }
    }  

    public function getMultipleColumnsMachine($id = null)
    {
        if (empty($id)) {
            $machines = Machine::select('machine_name', 'brand')->get();
            return response()->json([['machines'=>$machines]],200);
        } else {    
            $machines = Machine::select('machine_name', 'brand')->find($id);
            return response()->json([['machines'=>$machines]],200);

        }
    }  

    public function index(Request $request)
    {
        // Retrieve all machines but only the 'name' field
        $machines = Machine::all(['machine_name']);
        
        // Return the machines data as a wrapped response
        return response()->json(['data' => $machines]);
    }


    public function addMachine(Request $request)
    {
        if ($request->isMethod('post')) {
            $userData = $request->input();
            /*echo "<pre>"; print_r($userData); die;*/

            //Post API Validation to check user details
            // if (empty($userData['name']) ||empty($userData['email']) ||empty($userData['password'])
            //     ){
            //         $error_message = "Please enter your complete user details!";
            //     }

            // //Check if email is valid
            // if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)){
            //     $error_message = "Please enter valid Email!";
            // }

            // //Check if User Email Already Exists
            // $userCount = User::where("email",$userData["email"])->count();
            // if ($userCount>0) {
            //     $error_message = "Email already exists!";
            // }

            // //Error Message
            // if(isset($error_message)&&!empty($error_message)){
            //     return response()->json(["Status"=>false,"message"=>$error_message],422);
            // }

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

            
            $machine = new Machine;
            $machine->machine_name = $userData['machine_name'];
            $machine->brand = $userData['brand'];
            $machine->power_rating = $userData['power_rating'];
            $machine->manufactured_date = $userData['manufactured_date'];
            $machine->model_name = $userData['model_name'];
            $machine->rpm = $userData['rpm'];
            $machine->description_of_machine = $userData['description_of_machine'];
            $machine->save();
            return response()->json(['message'=>['Machine added successfully!']]);
        }
    }

        public function updateMachine(Request $request,$id){
            if ($request->isMethod('put')) {
                $userData = $request->input();
                // echo "prev"; print_r($userData);die;
                Machine::where("id", $id)->update([
                    "machine_name" => $userData["machine_name"],
                    'brand' => $userData['brand'],
                    'power_rating' => $userData['power_rating'], 
                    'manufactured_date' => $userData['manufactured_date'],
                    'model_name' => $userData['model_name'],
                    'rpm' => $userData['rpm'],
                    'description_of_machine' => $userData['description_of_machine']
                ]);
                return response()->json(['message' => ["Machine details updated successfully!"]], 202);
            }
        }

        public function updateMachineColumns(Request $request, $id)
        {
            if ($request->isMethod('put')) {
                $userData = $request->input();

                $updateData = [];

                if (isset($userData['machine_name'])) {
                    $updateData['machine_name'] = $userData['machine_name'];
                }
                if (isset($userData['brand'])) {
                    $updateData['brand'] = $userData['brand'];
                }
                if (isset($userData['power_rating'])) {
                    $updateData['power_rating'] = $userData['power_rating'];
                }
                if (isset($userData['manufactured_date'])) {
                    $updateData['manufactured_date'] = $userData['manufactured_date'];
                }
                if (isset($userData['model_name'])) {
                    $updateData['model_name'] = $userData['model_name'];
                }
                if (isset($userData['rpm'])) {
                    $updateData['rpm'] = $userData['rpm'];
                }
                if (isset($userData['description_of_machine'])) {
                    $updateData['description_of_machine'] = $userData['description_of_machine'];
                }

                if (!empty($updateData)) {
                    Machine::where("id", $id)->update($updateData);

                    return response()->json(['message' => ["Machine details updated successfully!"]], 202);
                } else {
                    return response()->json(['message' => ["No valid data to update."]], 400);
                }
            }
        }

        public function deleteMachine($id){
            Machine::where("id", $id)->delete();
            return response()->json(["message"=> ["User deleted successfully!"]],202);
        }


    
}

