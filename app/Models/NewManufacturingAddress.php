<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewManufacturingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        "blk_blg_street_village",
        "region",
        "province",
        "district",
        "municipality",
        "barangay"
    ];

    public function newMachine() {
        return $this->belongsTo('App\Models\NewMachine');
    }
    
}
