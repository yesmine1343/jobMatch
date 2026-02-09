<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;          //pwd requirements
/* 
POST /api/auth/logout → AuthController@logout (needs auth middleware)
*/
class AuthController extends Controller
{
    public function login(Request $request)
    {
        //validation
        $validatedForm= $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
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
    
    public function Register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)         
                    ->mixedCase()      
                    ->letters()        
                    ->numbers()        
                    ->symbols(),       
            ],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate authentication token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()-> json([
            'success' => true,
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ],201);
    }
}
