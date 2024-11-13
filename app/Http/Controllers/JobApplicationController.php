<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\Education;
use App\Models\Experience;

class JobApplicationController extends Controller
{
    public function create(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'applicant_name' => 'required|string',
            'email' => 'required|email',
            'application_status' => 'required|string',
            'education' => 'array',
            'experience' => 'array',
        ]);

        try {
            DB::beginTransaction();

            // Create the main job application record
            $jobApplication = JobApplication::create([
                'applicant_name' => $request->applicant_name,
                'email' => $request->email,
                'application_status' => $request->application_status,
            ]);

            // Create education records if provided
            if ($request->has('education')) {
                foreach ($request->education as $educationData) {
                    Education::create([
                        'degree' => $educationData['degree'],
                        'university' => $educationData['university'],
                        'year_graduated' => $educationData['year_graduated'],
                        'job_application_id' => $jobApplication->id
                    ]);
                }
            }

            // Create experience records if provided
            if ($request->has('experience')) {
                foreach ($request->experience as $experienceData) {
                    Experience::create([
                        'company_name' => $experienceData['company_name'],
                        'position' => $experienceData['position'],
                        'years_of_experience' => $experienceData['years_of_experience'],
                        'job_application_id' => $jobApplication->id
                    ]);
                }
            }

            DB::commit();

            // Return response with the created job application data
            return response()->json([
                'message' => 'Job Application created successfully!',
                'data' => $jobApplication->load(['education', 'experience'])  // Load education and experience relations
            ], 201);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating the job application'], 500);
        }
    }
}
