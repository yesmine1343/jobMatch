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
            'skills' => 'required|array',
            'skills.*' => 'string',
            'education_level' => 'nullable|in:High School,Bachelor,Master,PhD',
        ]);

        $profile = auth()->user()->candidateProfile;

        $matchingService = new MatchingService();

        $candidateData = [
            'skills' => $validated['skills'],
            'experience_level' => $profile->experience_level,
            'education_level' => $validated['education_level'] ?? null,
        ];

        $query = JobOffer::where('status', 'active')
            ->where('work_model', $profile->work_type)
            ->where('employment_type', $profile->employment_type);

        $jobs = $query->get();

        $matches = [];

        foreach ($jobs as $job) {
            $jobData = [
                'required_skills' => $job->required_skills ?? [],
                'required_experience_level' => $job->required_experience_level ?? 'Mid',
                'required_education' => $job->required_education ?? null,
            ];

            $score = $matchingService->calculate($candidateData, $jobData);

            $matches[] = [
                'id' => $job->id,
                'title' => $job->title,
                'location' => $job->location,
                'salary_min' => $job->salary_min,
                'salary_max' => $job->salary_max,
                'work_model' => $job->work_model,
                'match_score' => $score['final_score'],
            ];
        }

        usort($matches, fn($a, $b) => $b['match_score'] - $a['match_score']);

        return response()->json($matches);
    }
    public function show(Request $request)
    {
        $user = $request->user();
        $profile = $user->candidateProfile; // adjust to your relationship name

        return response()->json([
            'username' => $user->name,
            'email' => $user->email,
            'target_job_title' => $profile->target_job_title,
            'experience_level' => $profile->experience_level,
            'location_preference' => $profile->location_preference,
            'employment_type' => $profile->employment_type,
        ]);
    }
}