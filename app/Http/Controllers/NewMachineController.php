<?php

namespace App\Http\Controllers;

use App\Models\NewMachine;
use App\Models\NewManufacturingAddress;
use Illuminate\Http\Request;

class NewMachineController extends Controller
{
    public function index (NewManufacturingAddress $ma) {
        return $ma->newMachine;
    }
}
