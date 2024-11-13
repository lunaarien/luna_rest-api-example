<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name', 'position', 'years_of_experience', 'job_application_id'
    ];

    // Inverse relationship to JobApplication
    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class);
    }
}
