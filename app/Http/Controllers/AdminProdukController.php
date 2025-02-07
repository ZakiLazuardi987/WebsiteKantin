<?php

// namespace App\Http\Controllers;

// use App\Services\ProdukService;
// use App\Models\Kategori;
// use App\Services\FileUploadService;
// use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;

// class AdminProdukController extends Controller
// {
//     protected ProdukService $produkService;
//     protected FileUploadService $fileUploadService;

//     public function __construct(ProdukService $produkService, FileUploadService $fileUploadService)
//     {
//         $this->produkService = $produkService;
//         $this->fileUploadService = $fileUploadService;
//     }

//     public function index(Request $request)
//     {
//         // $produks = $this->produkService->getAllProducts(5);

//         $perPage = $request->get('perPage', 5);
//         $search = $request->get('search');

//         $produks = $this->produkService->getPaginatedProducts($perPage, $search);

//         $data = [
//             'title' => 'Kelola Produk',
//             'produk' => $produks,
//             'kategori' => Kategori::get(),
//             'search' => $search,
//             'perPage' => $perPage,
//             'content' => 'admin.produk.index',
//         ];

//         return view('admin.layouts.wrapper', $data);
//     }


//     public function create()
//     {
//         $data = [
//             'title' => 'Tambah Produk',
//             'kategori' => Kategori::get(),
//             'content' => 'admin/produk/create'
//         ];
//         return view('admin.layouts.wrapper', $data);
//     }

//     public function store(Request $request)
//     {
//         $data = $request->validate([
//             'name' => 'required',
//             'kategori_id' => 'required',
//             'harga' => 'required',
//             'stok' => 'required',
//             'keterangan' => 'nullable',
//             'gambar' => 'nullable|image |mimes:jpeg,png,jpg,gif|max:2048'
//         ]);

//         if ($request->hasFile('gambar')) {
//             $data['gambar'] = $this->fileUploadService->uploadFile($request->file('gambar'), 'uploads/images/');
//         }

//         $this->produkService->createProduct($data);
//         Alert::success('Sukses', 'Produk telah ditambahkan!');
//         return redirect('/admin/produk');
//     }

//     public function update(Request $request, string $id)
//     {
//         $data = $request->validate([
//             'name' => 'required',
//             'kategori_id' => 'required',
//             'harga' => 'required',
//             'stok' => 'required',
//             'keterangan' => 'nullable',
//             'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
//         ]);

//         if ($request->hasFile('gambar')) {
//             $data['gambar'] = $this->fileUploadService->uploadFile($request->file('gambar'), 'uploads/images/');
//         }

//         $this->produkService->updateProduct($id, $data);
//         Alert::success('Sukses', 'Produk telah berhasil diubah!');
//         return redirect('/admin/produk');
//     }

//     public function edit(string $id)
//     {
//         $data = [
//             'title' => 'Ubah Produk',
//             'produk' => $this->produkService->getProductById($id),
//             'kategori' => Kategori::get(),
//             'content' => 'admin/produk/edit'
//         ];
//         return view('admin.layouts.wrapper', $data);
//     }

//     public function destroy(string $id)
//     {
//         $this->produkService->deleteProduct($id);
//         Alert::success('Sukses', 'Produk telah dihapus!');
//         return redirect()->back();
//     }
// }
namespace App\Http\Controllers;

use App\Services\ProdukService;
use App\Models\Kategori;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminProdukController extends Controller
{
    protected ProdukService $produkService;
    protected FileUploadService $fileUploadService;

    public function __construct(ProdukService $produkService, FileUploadService $fileUploadService)
    {
        $this->produkService = $produkService;
        $this->fileUploadService = $fileUploadService;
    }

    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 5);
        $search = $request->get('search');
        $produks = $this->produkService->getPaginatedProducts($perPage, $search);

        $data = [
            'title' => 'Kelola Produk',
            'produk' => $produks,
            'kategori' => Kategori::get(),
            'search' => $search,
            'perPage' => $perPage,
            'content' => 'admin.produk.index',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    public function create()
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Tambah Produk',
            'kategori' => Kategori::get(),
            'content' => 'admin/produk/create'
        ]);
    }

    public function edit(string $id)
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Ubah Produk',
            'produk' => $this->produkService->getProductById($id),
            'kategori' => Kategori::get(),
            'content' => 'admin/produk/edit'
        ]);
    }

    public function destroy(string $id)
    {
        $this->produkService->deleteProduct($id);
        Alert::success('Sukses', 'Produk telah dihapus!');
        return redirect()->back();
    }
}
