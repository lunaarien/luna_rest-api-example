<?php

namespace App\Http\Controllers;

use App\Models\ManufacturingAddress;
use App\Models\NewManufacturingAddress;
use Illuminate\Http\Request;

class NewManufacturingAddressController extends Controller
{
        public function getMA($id = null)
        {
            if (empty($id)) {
                $ma = NewManufacturingAddress::get();
                return response()->json([['manufacturing address'=>$ma]],200);
            } else {    
                $ma = NewManufacturingAddress::find($id);
                return response()->json([['manufacturing address'=>$ma]],200);

            }
        } 

        public function addMA(Request $request)
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

                
                $ma = new NewManufacturingAddress;
                $ma->blk_blg_street_village = $userData['blk_blg_street_village'];
                $ma->region = $userData['region'];
                $ma->province = $userData['province'];
                $ma->district = $userData['district'];
                $ma->municipality = $userData['municipality'];
                $ma->barangay = $userData['barangay'];
                $ma->save();
                return response()->json(['message'=>['Manufacturing Address added successfully!']]);
            }
        }

        public function updateMA(Request $request,$id){
            if ($request->isMethod('put')) {
                $userData = $request->input();
                // echo "prev"; print_r($userData);die;
                NewManufacturingAddress::where("id", $id)->update([
                    "blk_blg_street_village" => $userData["blk_blg_street_village"],
                    'region' => $userData['region'],
                    'province' => $userData['province'], 
                    'district' => $userData['district'],
                    'municipality' => $userData['municipality'],
                    'barangay' => $userData['barangay'],
                ]);
                return response()->json(['message' => ["Manufacturing Address details updated successfully!"]], 202);
            }
        }

         public function updateMAColumns(Request $request, $id) {
            if ($request->isMethod('put')) {
                $userData = $request->input();

                $updateData = [];

                if (isset($userData['blk_blg_street_village'])) {
                    $updateData['blk_blg_street_village'] = $userData['blk_blg_street_village'];
                }
                if (isset($userData['region'])) {
                    $updateData['region'] = $userData['region'];
                }
                if (isset($userData['district'])) {
                    $updateData['district'] = $userData['district'];
                }
                if (isset($userData['municipality'])) {
                    $updateData['municipality'] = $userData['municipality'];
                }
                if (isset($userData['barangay'])) {
                    $updateData['barangay'] = $userData['barangay'];
                }
                if (!empty($updateData)) {
                    NewManufacturingAddress::where("id", $id)->update($updateData);

                    return response()->json(['message' => ["Manufacturing Address details updated successfully!"]], 202);
                } else {
                    return response()->json(['message' => ["No valid data to update."]], 400);
                }
            }
        }

        public function deleteMA($id){
            NewManufacturingAddress::where("id", $id)->delete();
            return response()->json(["message"=> ["User deleted successfully!"]],202);
        }

}
