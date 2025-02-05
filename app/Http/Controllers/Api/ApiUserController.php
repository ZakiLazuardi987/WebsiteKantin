<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiUserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = $this->userService->getAllUsers($search);

        return response()->json([
            'status' => 'success',
            'message' => 'Data user berhasil diambil',
            'data' => $users
        ], 200);
    }
    
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                're_password' => 'required|same:password',
            ]);

            $user = $this->userService->createUser($data);

            return response()->json([
                'status' => 'success',
                'message' => 'User berhasil ditambahkan',
                'data' => $user
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function show(string $id)
    {
        $user = $this->userService->getUserById((int) $id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data user berhasil diambil',
            'data' => $user
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:6',
                're_password' => 'nullable|same:password',
            ]);

            unset($data['re_password']);

            $updateResult = $this->userService->updateUser((int) $id, $data, $request->old_password);

            if (!$updateResult) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password lama tidak sesuai atau data tidak ditemukan'
                ], 400);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data user berhasil diperbarui'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function destroy(string $id)
    {
        $deleted = $this->userService->deleteUser((int) $id);

        if (!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dihapus'
        ], 200);
    }
}
