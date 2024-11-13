<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        "machine_name",
        "brand",
        "power_rating",
        "manufactured_date",
        "model_name",
        "rpm",
        "description_of_machine",
    ];

    
}
