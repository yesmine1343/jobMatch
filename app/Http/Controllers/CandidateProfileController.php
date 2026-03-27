<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateProfile;
use App\Models\JobOffer;
use App\Services\MatchingService;

class CandidateProfileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jobTitle'        => 'required|string|max:255',
            'experienceLevel' => 'required|in:Junior,Mid,Senior,Lead',
            'workType'        => 'required|in:Remote,Hybrid,On-site',
            'employmentType'  => 'required|in:Full-time,Part-time,Contract,Internship',
            'location'        => 'nullable|string',
        ]);

        $profile = CandidateProfile::create([
            'user_id'             => auth()->id(),
            'target_job_title'    => $request->jobTitle,
            'experience_level'    => $request->experienceLevel,
            'work_type'           => $request->workType,
            'employment_type'     => $request->employmentType,
            'location_preference' => $request->location,
        ]);

        return response()->json([
            'message' => 'Profile saved',
            'profile' => $profile
        ]);
    }

    public function getMatches(Request $request)
    {
        $validated = $request->validate([
            'skills' => 'nullable|array',  // ← CHANGE: Make skills optional
            'skills.*' => 'string',
            'education_level' => 'nullable|in:High School,Bachelor,Master,PhD',
        ]);

        $profile = auth()->user()->candidateProfile;

        // ADD THIS CHECK
        if (!$profile) {
            return response()->json([
                'message' => 'Complete your candidate profile before viewing matches.'
            ], 422);
        }

        $matchingService = new MatchingService();

        $candidateData = [
            'skills' => $validated['skills'] ?? [],
            'experience_level' => $profile->experience_level,
            'education_level' => $validated['education_level'] ?? null,
        ];
        
        // ... rest of code
    }
    public function show(Request $request)
    {
        $user = $request->user();
        $profile = $user->candidateProfile;

        if (!$profile) {
            return response()->json(['message' => 'Candidate profile not found.'], 404);
        }

        return response()->json([
            'username' => $user->username,
            'email' => $user->email,
            'target_job_title' => $profile->target_job_title,
            'experience_level' => $profile->experience_level,
            'location_preference' => $profile->location_preference,
            'employment_type' => $profile->employment_type,
        ]);
    }
    public function delete(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();
        $user->delete();

        return response()->json(['message' => 'Account deleted successfully']);
    }
}