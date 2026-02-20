<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecruiterProfile;

class RecruiterProfileController extends Controller
{
    public function store(Request $request)
    {
        // Map incoming frontend camelCase keys or legacy snake_case to DB column names
        $data = [
            'company_name' => $request->companyName ?? $request->company_name,
            'industry' => $request->industry ?? $request->industry,
            'company_size' => $request->companySize ?? $request->company_size,
            'default_hiring_location' => $request->hiringLocation ?? $request->location ?? $request->default_hiring_location ?? null,
            'default_work_model' => $request->workModel ?? $request->work_model ?? $request->default_work_model ?? null,
        ];

        $validator = \Validator::make($data, [
            'company_name' => 'required|string',
            'industry' => 'required|string',
            'company_size' => 'required|string',
            'default_hiring_location' => 'nullable|string',
            'default_work_model' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile = RecruiterProfile::create(array_merge($data, ['user_id' => auth()->id()]));

        return response()->json([
            'message' => 'Profile saved',
            'profile' => $profile
        ]);
    }
}
