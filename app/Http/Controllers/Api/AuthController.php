<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;


class AuthController extends Controller
{
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }

    public function login(Request $request)
    {
        // Validation
        $validatedForm = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'username' => 'nullable|string',
            'active_role' => 'nullable|in:candidate,recruiter',
            'profile_completed' => 'nullable|boolean',

        ]);

        // Find user by email
        $user = User::where('email', $validatedForm['email'])->first();

        // Check if user exists
        if (!$user) {
            return response()->json([
                'error_type' => 'account_not_found',
                'message' => 'This account does not exist.'
            ], 401);
        }

        // Check if password is correct
        if (!Hash::check($validatedForm['password'], $user->password)) {
            return response()->json([
                'error_type' => 'invalid_credentials',
                'message' => 'Invalid credentials.'
            ], 401);
        }

        // Generate authentication token
        $token = $user->createToken('auth-token')->plainTextToken;

        // Success response with token
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ], 200);
    }
//reset link broker
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Debug: Check if user exists
        $userExists = \App\Models\User::where('email', $request->email)->exists();
        \Log::info("Password reset requested for: " . $request->email . " (Exists: " . ($userExists ? 'Yes' : 'No') . ")");

        // This sends a secure token to the user's email
        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        // We return success regardless for security reasons
        return response()->json([
            'message' => 'If an account exists with this email, you will receive a reset link.'
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                PasswordRule::min(8)->mixedCase()->letters()->numbers()->symbols(),
            ],
        ]);

        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(\Illuminate\Support\Str::random(60));

                $user->save();

                // Revoke all tokens to logout from all devices
                $user->tokens()->delete();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password has been reset.'], 200)
            : response()->json(['message' => 'Invalid token or email.'], 422);
    }
    
    public function Register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                PasswordRule::min(8)         
                    ->mixedCase()      
                    ->letters()        
                    ->numbers()        
                    ->symbols(),       
            ],
            'active_role' => 'nullable|in:candidate,recruiter',
            'profile_completed' => 'nullable|boolean',      ]);


        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active_role' =>null,
            'profile_completed'=>false, 
        ]);

        // Generate authentication token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()-> json([
            'success' => true,
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function checkUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255'
        ]);

        $exists = User::where('username', $request->username)->exists();

        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Username is already taken' : 'Username is available'
        ]);
    }

    public function userIdentityVerification(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);


        return response()->json([
            
        ]);
    }
    
    public function sendEmail(Request $request)
    {
        $receiver = $request->email;

        Mail::to($receiver)->send(new TestMail());
    }

}