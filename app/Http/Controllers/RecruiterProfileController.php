<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecruiterProfile;

class RecruiterProfileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'companyName' => 'required|string',
            'industry' => 'required|string',
            'companySize' => 'required|string',
            'hiringLocation' => 'nullable|string',
            'workModel' => 'required|string',
                    ]);
        
        $profile = RecruiterProfile::create([
            'user_id'=> auth()->id(),
            'company_name'=> $request->companyName ,
            'industry' => $request->industry,
            'company_size' => $request->companySize,
            'hiring_location' => $request->hiringLocation,
            'work_model' => $request->workModel,
        ]);

        return response()->json([
            'message' => 'Profile saved',
            'profile' => $profile
        ]);
    }
}
