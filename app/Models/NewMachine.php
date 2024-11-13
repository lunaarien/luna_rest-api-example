<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewMachine extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturing_id',
        'machine_name',
        'brand', 
        'power_rating', 
        'manufactured_date', 
        'model_name', 
        'rpm', 
        'description_of_machine',
    ];

    public function newManufacturingAddress() {
        return $this->belongsTo('App\Models\NewManufacturingAddress');
    }

}
