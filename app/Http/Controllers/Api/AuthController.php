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
        // Validation
        $validatedForm = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'username' => 'nullable|string'
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
            'username' => 'required|string|max:255|unique:users',
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
            'username' => $request->username,
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
    public function handleEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $apiKey = config('services.openai.key');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type'  => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful assistant.',
                ],
                [
                    'role' => 'user',
                    'content' => "User submitted this email: {$email}. Respond politely.",
                ],
            ],
        ]);

        return response()->json([
            'message' => $response->json('choices.0.message.content'),
        ]);
    }
}
