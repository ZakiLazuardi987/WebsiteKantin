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

    // Menampilkan daftar produk dengan paginasi dan pencarian dalam bentuk API
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 5);
        $search = $request->get('search', '');

        $produks = $this->produkService->getPaginatedProducts($perPage, $search);

        return response()->json([
            'status' => 'success',
            'data' => $produks,
            'message' => 'Produk berhasil diambil.',
        ], 200);
    }

    // Menampilkan form tambah produk (diubah untuk response API)
    public function create()
    {
        return response()->json([
            'status' => 'success',
            'kategori' => Kategori::all(),
            'message' => 'Data kategori berhasil diambil.'
        ], 200);
    }

    // Menyimpan produk baru (untuk API)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->fileUploadService->uploadFile($request->file('gambar'), 'uploads/images/');
        }

        $product = $this->produkService->createProduct($data);

        return response()->json([
            'status' => 'success',
            'data' => $product,
            'message' => 'Produk berhasil ditambahkan!',
        ], 201);
    }

    // Mengubah produk yang ada (untuk API)
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->fileUploadService->uploadFile($request->file('gambar'), 'uploads/images/');
        }

        $product = $this->produkService->updateProduct($id, $data);

        return response()->json([
            'status' => 'success',
            'data' => $product,
            'message' => 'Produk berhasil diubah!',
        ], 200);
    }

    // Mengambil data produk untuk form edit produk (API)
    public function edit(string $id)
    {
        $produk = $this->produkService->getProductById($id);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $produk,
            'message' => 'Data produk ditemukan.',
        ], 200);
    }

    // Menghapus produk (API)
    public function destroy(string $id)
    {
        $this->produkService->deleteProduct($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus!',
        ], 200);
    }
}
