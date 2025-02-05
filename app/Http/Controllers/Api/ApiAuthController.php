<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang diberikan tidak valid.',
                'errors' => $validator->errors(),
            ], 400); // 400 Bad Request
        }

        $data = $request->only('email', 'password');

        // Proses login
        $loginSuccess = $this->authService->attemptLogin($data);

        if ($loginSuccess) {
            // Generate token untuk API
            $user = User::where('email', $data['email'])->first();
            $token = $user->createToken('AdminToken')->plainTextToken;
            session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil!',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ], 200); // 200 OK
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah!',
        ], 401); // 401 Unauthorized

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        Auth::guard('web')->logout();

        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil!',
        ], 200);
    }

    // public function logout(Request $request)
    // {
    //     $request->user()->tokens->each(function ($token) {
    //         $token->delete();
    //     });

    //     // $request->user()->currentAccessToken()->delete();

    //     Auth::guard('web')->logout();
    //     $this->authService->logout();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Logout Berhasil!',
    //     ], 200);
    // }
}
