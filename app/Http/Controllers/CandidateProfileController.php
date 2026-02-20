<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateProfile;

class CandidateProfileController extends Controller
{
    //
    public function store(Request $request)
    {
        dd(auth()->id(), $request->all());
        $request->validate([
            'jobTitle'        => 'required|string|max:255',
            'experienceLevel' => 'required|in:Junior,Mid,Senior,Lead',
            'workType'        => 'required|in:Remote,Hybrid,On-site',
            'employmentType'  => 'required|in:Full-time,Part-time,Contract,Internship',
            'salary'          => 'nullable|integer|min:500|max:6000',
            'availability'    => 'required|string',
            'location'        => 'nullable|string|max:255',
        ]);

        $profile = CandidateProfile::create([
            'user_id'            => auth()->id(),
            'target_job_title'   => $request->jobTitle,
            'experience_level'   => $request->experienceLevel,
            'work_type'          => $request->workType,
            'employment_type'    => $request->employmentType,
            'expected_salary'    => $request->salary,
            'availability'       => $request->availability,
            'location_preference' => $request->location, 
        ]);
        dd($profile);
     //   auth()->user()->update(['profile_completed' => true]);

        return response()->json([
            'message' => 'Profile saved',
            'profile' => $profile
        ]);
    }
}
