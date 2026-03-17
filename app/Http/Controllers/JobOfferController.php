<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOffer;

class jobOfferController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'jobTitle' => 'required|string|max:255',
                'department' => 'nullable|string|max:255',
                'location' => 'required|string|max:255',
                'workModel' => 'required|in:Remote,Hybrid,On-site',
                'employmentTypes' => 'required|array',
                'employmentTypes.*' => 'in:Full-time,Part-time,Contract,Internship',
                'experienceLevel' => 'required|in:Junior,Mid,Senior,Lead',
                'salary' => 'nullable|integer|min:500|max:6000',
                'mustHaveSkills' => 'nullable|array',
                'niceToHaveSkills' => 'nullable|array',
                'softSkills' => 'nullable|array',
            ]);

            \Log::info('Job validation passed:', $validated);

            $recruiterProfile = auth()->user()->recruiterProfile;
            if (!$recruiterProfile) {
                return response()->json(['message' => 'Only recruiters can create jobs'], 403);
            }

            $job = $recruiterProfile->jobOffers()->create([
                'title' => $validated['jobTitle'],
                'department' => $validated['department'] ?? null,
                'location' => $validated['location'],
                'work_model' => $validated['workModel'],
                'employment_type' => implode(',', $validated['employmentTypes']),
                'required_experience_level' => $validated['experienceLevel'],
                'salary_min' => $validated['salary'] ?? null,
                'salary_max' => $validated['salary'] ?? null,
                'required_skills' => json_encode($validated['mustHaveSkills'] ?? []),
                'optional_skills' => json_encode($validated['niceToHaveSkills'] ?? []),
                'soft_skills' => json_encode($validated['softSkills'] ?? []),
                'status' => 'active',
            ]);

            \Log::info('Job created successfully:', ['id' => $job->id, 'title' => $job->title]);

            return response()->json($job, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error:', $e->errors());
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('JobOffer store error:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    //RecruiterDashboard.vue ; CandidateDashboard.vue
    public function index()
    {
        try {
            $user = auth()->user();

            // Recruiter sees ONLY their jobs
            if ($user->recruiterProfile) {
                $jobs = $user->recruiterProfile
                    ->jobOffers()
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
                \Log::info('Recruiter jobs fetched:', ['count' => $jobs->count()]);
                return response()->json($jobs);
            }

            // Candidate sees ALL active jobs
            if ($user->candidateProfile) {
                $jobs = JobOffer::where('status', 'active')
                    ->with('recruiterProfile')
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
                \Log::info('Candidate jobs fetched:', ['count' => $jobs->count()]);
                return response()->json($jobs);
            }

            return response()->json([], 200);
        } catch (\Exception $e) {
            \Log::error('JobOffer index error:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    //JobDetails.vue
    public function show($id)
    {
        $job = JobOffer::with('recruiterProfile')->findOrFail($id);
        return response()->json($job);
    }
    //EditJob.vue
    public function update(Request $request, $id)
    {
        $job = JobOffer::findOrFail($id);

        $recruiterProfile = auth()->user()->recruiterProfile;

        if (!$recruiterProfile || $job->recruiter_profile_id !== $recruiterProfile->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $job->update($request->all());

        return response()->json($job);
    }
    //RecruiterDashboard.vue
    public function destroy($id)
    {
        $job = JobOffer::findOrFail($id);

        $recruiterProfile = auth()->user()->recruiterProfile;

        if (!$recruiterProfile || $job->recruiter_profile_id !== $recruiterProfile->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $job->delete();

        return response()->json(['message' => 'Deleted']);
    }
    
}
