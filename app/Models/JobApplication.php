<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_name', 
        'email', 
        'application_status'
    ];

    // Relationship to Education (one-to-many)
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    // Relationship to Experience (one-to-many)
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
}
