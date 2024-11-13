<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'degree', 'university', 'year_graduated', 'job_application_id'
    ];

    // Inverse relationship to JobApplication
    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class);
    }
}
