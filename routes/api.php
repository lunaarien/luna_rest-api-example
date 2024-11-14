<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\NewMachineController;
use App\Http\Controllers\NewManufacturingAddressController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function ($router) {

    //Users
    Route::get('users/{id?}', [APIController::class, 'getUsers']); // To get the ID
    Route::get('users1/{id?}', [APIController::class, 'getNameUsers']); // To get 1 specific column (name)
    Route::get('users2/{id?}', [APIController::class, 'getMultipleColumnUsers']); // To get multiple specific columns
    Route::post('add-users', [APIController::class, 'addUsers']); // To add a new user


    //Machine
    Route::get('machines/{id?}', [MachineController::class,'getMachine']);
    Route::get('machines1/{id?}', [MachineController::class,'getMachineName']);
    Route::get('machines2/{id?}', [MachineController::class,'getMultipleColumnsMachine']);
    Route::post('add-machines', [MachineController::class,'addMachine']);
    Route::put('update-machines/{id}', [MachineController::class,'updateMachine']); //update machines using id
    Route::put('update-machines1/{id}', [MachineController::class,'updateMachineColumns']); //update machines using id
    Route::delete('delete-machines/{id}', [MachineController::class,'deleteMachine']); //update machines using id

    //Manufacturing Address
    Route::get('manufacturing/{id?}', [NewManufacturingAddressController::class,'getMA']);
    Route::post('add-manufacturing/{id?}', [NewManufacturingAddressController::class,'addMA']);
    Route::put('update-manufacturing/{id?}', [NewManufacturingAddressController::class,'updateMA']);
    Route::put('update-manufacturing1/{id?}', [NewManufacturingAddressController::class,'updateMAColumns']);
    Route::delete('delete-manufacturing/{id?}', [NewManufacturingAddressController::class,'deleteMA']);

    //Testing 2 Relation Tables
    Route::get('machines/{id}/newmachines', [NewMachineController::class, 'index']);
    Route::get('machines/{id}/combinerecords', [NewMachineController::class, 'index1']);
    Route::get('machines/{id}/specificrecords', [NewMachineController::class, 'index2']);
    Route::post('machines', [NewMachineController::class, 'store']);

});







