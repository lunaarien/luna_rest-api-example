<?php

namespace App\Http\Controllers;

use App\Models\NewMachine;
use App\Models\NewManufacturingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewMachineController extends Controller
{
    // public function index(NewManufacturingAddress $ma) {
    //     return $ma->newmachines; 
    // }

    // public function index()
    // {
    //     // Use eager loading to fetch machines with their associated manufacturing addresses
    //     $machines = NewMachine::with('newmanufacturingaddress')->get();

    //     return response()->json($machines);
    // }

        public function index($id)
        {
            $ma = NewManufacturingAddress::find($id);
            
            if (!$ma) {
                return response()->json(['message' => 'Manufacturing address not found'], 404);
            }

            return response()->json($ma->newmachines); 
        }

        public function index1($id)
        {
            // Retrieve the machine with the given ID and load the related manufacturing address
            $machine = NewMachine::with('newmanufacturingaddress')->find($id);

            // Check if the machine exists
            if (!$machine) {
                return response()->json([
                    'message' => 'Machine not found'
                ], 404); // Return a 404 if the machine is not found
            }

            // Combine the machine and its manufacturing address into one response
            $machineData = $machine->toArray(); // Convert the machine model to an array

            // Add the related manufacturing address under 'newmanufacturingaddress'
            $machineData['newmanufacturingaddress'] = $machine->newmanufacturingaddress;

            // Return the combined response
            return response()->json([
                'machine' => $machineData,
            ], 200); // Return a 200 response with the data
        }


        public function index2($id)
        {
             // Retrieve the machine with specific columns and its related manufacturing address with specific columns
            $machine = NewMachine::with(['newmanufacturingaddress' => function ($query) {
                // Select specific columns from NewManufacturingAddress
                $query->select('id', 'blk_blg_street_village', 'region');
            }])
            ->select('id', 'machine_name', 'brand', 'power_rating', 'manufactured_date', 'manufacturing_id')  // Include 'manufacturing_id'
            ->find($id);

            // Check if the machine exists
            if (!$machine) {
                return response()->json([
                    'message' => 'Machine not found'
                ], 404); // Return a 404 if the machine is not found
            }

            // Get the related manufacturing address
            $manufacturingAddress = $machine->newmanufacturingaddress;

            // Combine the machine and its manufacturing address into one response
            $machineData = $machine->toArray(); // Convert the machine model to an array

            // Move manufacturing address into 'manufacturing_address' field
            if ($manufacturingAddress) {
                $machineData['manufacturing_address'] = [
                    'id' => $manufacturingAddress->id,
                    'blk_blg_street_village' => $manufacturingAddress->blk_blg_street_village,
                    'region' => $manufacturingAddress->region
                ];
            }

            // Remove the 'manufacturing_id' field
            unset($machineData['manufacturing_id']);
            // Remove the 'newmanufacturingaddress' field
            unset($machineData['newmanufacturingaddress']);

            // Return the combined response
            return response()->json([
                'machine' => $machineData,
            ], 200); // Return a 200 response with the data
        }



        public function store(Request $request)
        {
            $validated = $request->validate([
                'blk_blg_street_village' => 'required|string|max:255',
                'region' => 'required|string|max:100',
                'province' => 'required|string|max:100',
                'district' => 'required|string|max:100',
                'municipality' => 'required|string|max:100',
                'barangay' => 'required|string|max:100',
                'machine_name' => 'required|string|max:100',
                'brand' => 'required|string|max:100',
                'power_rating' => 'nullable|numeric',
                'manufactured_date' => 'nullable|date',
                'model_name' => 'nullable|string|max:100',
                'rpm' => 'nullable|integer',
                'description_of_machine' => 'nullable|string|max:255',
            ]);

            DB::beginTransaction();

            try {
                $newAddress = NewManufacturingAddress::create([
                    'blk_blg_street_village' => $validated['blk_blg_street_village'],
                    'region' => $validated['region'],
                    'province' => $validated['province'],
                    'district' => $validated['district'],
                    'municipality' => $validated['municipality'],
                    'barangay' => $validated['barangay'],
                ]);

                $newMachine = NewMachine::create([
                    'manufacturing_id' => $newAddress->id,  
                    'machine_name' => $validated['machine_name'],
                    'brand' => $validated['brand'],
                    'power_rating' => $validated['power_rating'],
                    'manufactured_date' => $validated['manufactured_date'],
                    'model_name' => $validated['model_name'],
                    'rpm' => $validated['rpm'],
                    'description_of_machine' => $validated['description_of_machine'],
                ]);

                DB::commit();

                return response()->json([
                    'message' => 'Machine and manufacturing address created successfully!',
                    'machine' => $newMachine,
                    'manufacturing_address' => $newAddress,
                ], 201);  

            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json([
                    'message' => 'An error occurred while creating the machine and address.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }

        
}

