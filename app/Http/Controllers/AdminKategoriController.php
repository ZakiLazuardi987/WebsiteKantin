<?php

namespace App\Http\Controllers;

use App\Services\KategoriService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKategoriController extends Controller
{
    protected KategoriService $kategoriService;

    public function __construct(KategoriService $kategoriService)
    {
        $this->kategoriService = $kategoriService;
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Kategori',
            'kategori' => $this->kategoriService->getAllCategories(5),
            'content' => 'admin/kategori/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori',
            'content' => 'admin/kategori/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:kategoris'
        ]);

        $this->kategoriService->createCategory($data);
        Alert::success('Sukses', 'Kategori telah ditambahkan!');
        return redirect('/admin/kategori');
    }

    public function edit(string $id)
    {
        $data = [
            'title' => 'Ubah Kategori',
            'kategori' => $this->kategoriService->getCategoryById($id),
            'content' => 'admin/kategori/edit'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|unique:kategoris,name,' . $id
        ]);

        $this->kategoriService->updateCategory($id, $data);
        Alert::success('Sukses', 'Kategori telah berhasil diubah!');
        return redirect('/admin/kategori');
    }

    public function destroy(string $id)
    {
        $this->kategoriService->deleteCategory($id);
        Alert::success('Sukses', 'Kategori telah dihapus!');
        return redirect()->back();
    }
}
