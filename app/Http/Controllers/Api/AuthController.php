<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/* 
POST /api/auth/register → AuthController@register
POST /api/auth/logout → AuthController@logout (needs auth middleware)
POST /api/auth/forgot-password → AuthController@forgotPassword
*/
class AuthController extends Controller
{
    public function login(Request $request)
    {
        //validation
        $validatedForm= $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'username' => 'nullable|string'
        ]);
        //find user
        $user = User::where('email', $validated['email'])->first();
        //exists and correct pwd - success msg; exists and incorrect pwd - forgotpwd redirect ; sign up redirect; incorrect pwd - false credentials msg
        if(Auth::attempt($validatedForm)){                     //idk 
            $request->session()->regenerate();
        } else {
            return response()->json([
                'message' => 'User does not exist. Please sign up.'
            ], 401);
        }
        //authenticated token
        $token = $user->createToken('auth-token')->plainTextToken;
        //success response with token
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    // Handler sfor forgot password functionality
    public function forgotPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // TODO: Send password reset email
        // For now, just return success message
        return response()->json([
            'message' => 'Password reset email sent successfully'
        ], 200);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
