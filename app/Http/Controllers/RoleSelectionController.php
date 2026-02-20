<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateProfile;
use App\Models\RecruiterProfile;

class RoleSelectionController extends Controller
{
    //

   public function selectRole(Request $request)
   {

        $request->validate([
            'role' => 'required|in:candidate,recruiter',
        ]);

        $user = auth()->user();

        $user->update([
            'active_role' => $request->role
        ]);

        return response()->json(['message' => 'Role selected']);
    }
}
