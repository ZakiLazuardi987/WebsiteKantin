<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = $this->userService->getAllUsers();

        if ($search) {
            $users = $users->filter(function ($user) use ($search) {
                return str_contains(strtolower($user->name), strtolower($search)) ||
                    str_contains(strtolower($user->email), strtolower($search));
            });
        }

        $data = [
            'title' => 'Kelola Data User',
            'user' => $users,
            'content' => 'admin.user.index',
        ];

        return view('admin.layouts.wrapper', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Data User',
            'content' => 'admin.user.create',
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            're_password' => 'required|same:password',
        ]);

        $this->userService->createUser($data);
        Alert::success('Sukses', 'Data telah ditambahkan!');
        return redirect('/admin/user');
    }

    public function edit(string $id)
    {
        $data = [
            'title' => 'Ubah Data User',
            'user' => $this->userService->getUserById((int) $id),
            'content' => 'admin.user.edit',
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'old_password' => 'nullable',
            'password' => 'nullable|min:6',
            're_password' => 'same:password',
        ]);

        Log::info('Data validasi:', ['data' => $data]);

        $user = $this->userService->getUserById((int) $id);

        // if ($request->filled('old_password')) {
        //     if (!Hash::check($request->old_password, $user->password)) {
        //         Log::info('Password lama salah:', ['old_password' => $request->old_password, 'stored_password' => $user->password]);
        //         return back()->withErrors(['old_password' => 'Password lama tidak sesuai!'])->withInput();
        //     }

        //     $data['password'] = $request->password;
        // }

        unset($data['old_password'], $data['re_password']);

        $updateResult = $this->userService->updateUser((int) $id, $data, $request->old_password);

        Log::info('Hasil update user:', ['updateResult' => $updateResult]);

        if ($updateResult) {
            Alert::success('Sukses', 'Data telah berhasil diubah!');
        } else {
            Alert::error('Gagal', 'Password lama tidak sesuai atau data tidak ditemukan!');
        }

        return redirect('/admin/user');
    }



    public function destroy(string $id)
    {
        if ($this->userService->deleteUser((int) $id)) {
            Alert::success('Sukses', 'Data telah dihapus!');
        } else {
            Alert::error('Gagal', 'Data tidak ditemukan!');
        }
        return redirect()->back();
    }
}
