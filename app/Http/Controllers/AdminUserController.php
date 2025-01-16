<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Data User',
            'user' => $this->userService->getAllUsers(),
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
            're_password' => 'same:password',
        ]);

        if ($this->userService->updateUser((int) $id, $data)) {
            Alert::success('Sukses', 'Data telah berhasil diubah!');
        } else {
            Alert::error('Gagal', 'Data tidak ditemukan!');
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
