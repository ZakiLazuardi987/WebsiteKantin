<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProdukService;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class ApiProdukController extends Controller
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
        $perPage = $request->get('perPage', 15);
        $search = $request->get('search', '');
        $produks = $this->produkService->getPaginatedProducts($perPage, $search);

        return response()->json(['status' => 'success', 'data' => $produks, 'message' => 'Produk berhasil diambil.'], 200);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|unique:produks,name',
                'kategori_id' => 'required',
                'harga' => 'required',
                'stok' => 'required',
                'keterangan' => 'required',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($request->hasFile('gambar')) {
                $data['gambar'] = $this->fileUploadService->uploadFile($request->file('gambar'), 'uploads/images/');
            }

            $product = $this->produkService->createProduct($data);
            return response()->json(['status' => 'success', 'data' => $product, 'message' => 'Produk berhasil ditambahkan!'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            if ($errors->has('name')) {
                return response()->json(['status' => 'error', 'message' => 'Nama produk sudah digunakan, silakan gunakan nama lain.'], 422);
            }
            throw $e;
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|unique:produks,name,' . $id,
                'kategori_id' => 'required',
                'harga' => 'required',
                'stok' => 'required',
                'keterangan' => 'required',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($request->hasFile('gambar')) {
                $data['gambar'] = $this->fileUploadService->uploadFile($request->file('gambar'), 'uploads/images/');
            }

            $product = $this->produkService->updateProduct($id, $data);
            return response()->json(['status' => 'success', 'data' => $product, 'message' => 'Produk berhasil diubah!'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            if ($errors->has('name')) {
                return response()->json(['status' => 'error', 'message' => 'Nama produk sudah digunakan, silakan gunakan nama lain.'], 422);
            }
            throw $e;
        }
    }


    public function destroy(string $id)
    {
        $this->produkService->deleteProduct($id);
        return response()->json(['status' => 'success', 'message' => 'Produk berhasil dihapus!'], 200);
    }

    public function show(string $id)
    {
        $product = $this->produkService->getProductById($id);

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Produk tidak ditemukan!'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $product, 'message' => 'Produk berhasil diambil.'], 200);
    }
}
