<?php

namespace App\Http\Controllers\Api;

use App\Services\KategoriService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ApiKategoriController extends Controller
{
    protected KategoriService $kategoriService;

    public function __construct(KategoriService $kategoriService)
    {
        $this->kategoriService = $kategoriService;
    }

    // Menampilkan semua kategori (dengan pagination & search)
    public function index(Request $request): JsonResponse
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 5);

        $kategoris = $this->kategoriService->getAllCategories($perPage, $search);

        return response()->json([
            'status' => 'success',
            'message' => 'Data kategori berhasil diambil',
            'data' => $kategoris
        ], 200);
    }

    // Menyimpan kategori baru
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|unique:kategoris'
        ]);

        $kategori = $this->kategoriService->createCategory($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $kategori
        ], 201);
    }

    // Menampilkan kategori berdasarkan ID
    public function show(string $id): JsonResponse
    {
        $kategori = $this->kategoriService->getCategoryById($id);

        if (!$kategori) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data kategori ditemukan',
            'data' => $kategori
        ], 200);
    }

    // Mengupdate kategori berdasarkan ID
    public function update(Request $request, string $id): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|unique:kategoris,name,' . $id
        ]);

        $updated = $this->kategoriService->updateCategory($id, $data);

        if (!$updated) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kategori gagal diperbarui'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil diperbarui',
            'data' => $updated
        ], 200);
    }

    // Menghapus kategori berdasarkan ID
    public function destroy(string $id): JsonResponse
    {
        $deleted = $this->kategoriService->deleteCategory($id);

        if (!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kategori tidak ditemukan atau gagal dihapus'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil dihapus'
        ], 200);
    }
}
