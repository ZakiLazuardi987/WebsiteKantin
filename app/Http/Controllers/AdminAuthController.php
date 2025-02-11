<?php

// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Services\AuthService; // Perbaiki ini ke service
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
// use RealRashid\SweetAlert\Facades\Alert;

// class AdminAuthController extends Controller
// {
//     protected AuthService $authService;

//     public function __construct(AuthService $authService)
//     {
//         $this->authService = $authService;
//     }

//     public function index()
//     {
//         return view('admin/auth/login');
//     }

//     public function doLogin(Request $request)
//     {
//         $data = $request->validate([
//             'email' => 'required|email',
//             'password' => 'required' // Tambahkan minimal karakter jika diperlukan
//         ]);

//         // Debug data login yang diterima
//         Log::info('Data login diterima:', ['data' => $data]);

//         // Proses login
//         $loginSuccess = $this->authService->attemptLogin($data);

//         // Debug hasil login
//         Log::info('Hasil login:', ['loginSuccess' => $loginSuccess]);

//         if ($loginSuccess) {
//             $request->session()->regenerate(); // Regenerate session untuk keamanan
//             Alert::success('Sukses', 'Login Berhasil!');
//             return redirect('/admin/dashboard');
//         }

//         // Jika gagal login
//         Alert::error('Gagal', 'Email atau password salah!');
//         return back()->withInput()->withErrors(['email' => 'Email atau password salah!']); // Tetap menyimpan input kecuali password
//     }

//     public function logout()
//     {
//         $this->authService->logout();
//         return redirect('/');
//     }
// }

// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Services\AuthService;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;

// class AdminAuthController extends Controller
// {
//     protected AuthService $authService;

//     public function __construct(AuthService $authService)
//     {
//         $this->authService = $authService;
//     }

//     public function index()
//     {
//         return response()->json(['message' => 'Please login'], 200);
//     }

//     public function doLogin(Request $request)
//     {
//         $data = $request->validate([
//             'email' => 'required|email',
//             'password' => 'required'
//         ]);

//         Log::info('Data login diterima:', ['data' => $data]);

//         $loginSuccess = $this->authService->attemptLogin($data);

//         Log::info('Hasil login:', ['loginSuccess' => $loginSuccess]);

//         if ($loginSuccess) {
//             $request->session()->regenerate();
//             return response()->json([
//                 'success' => true,
//                 'message' => 'Login Berhasil!',
//                 'redirect' => '/admin/dashboard'
//             ], 200);
//         }

//         return response()->json([
//             'success' => false,
//             'message' => 'Email atau password salah!'
//         ], 401);
//     }

//     public function logout(Request $request)
//     {
//         $this->authService->logout();

//         return response()->json([
//             'success' => true,
//             'message' => 'Logout Berhasil!',
//             'redirect' => '/'
//         ], 200);
//     }
// }

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\AuthService;

class AdminAuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('admin.auth.login');
    }
    public function logout()
    {
        $this->authService->logout();
        return redirect('/');
    }
}
