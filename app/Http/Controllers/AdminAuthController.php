<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AuthService; // Perbaiki ini ke service
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('admin/auth/login');
    }

    public function doLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required' // Tambahkan minimal karakter
        ]);

        if ($this->authService->attemptLogin($data)) {
            $request->session()->regenerate();
            Alert::success('Sukses', 'Login Berhasil!');
            return redirect('/admin/dashboard');
        }

        Alert::error('Gagal', 'Email atau password salah!');
        return back()->withInput(); // Tetap menyimpan input kecuali password
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect('/');
    }
}
