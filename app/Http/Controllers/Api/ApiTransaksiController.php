<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TransaksiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiTransaksiController extends Controller
{
    protected TransaksiService $transaksiService;

    public function __construct(TransaksiService $transaksiService)
    {
        $this->transaksiService = $transaksiService;
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('perPage', 25);
        $transactions = $this->transaksiService->getAllTransactions($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $transactions->items(), // Hanya kirim array transaksi
            'message' => 'Daftar transaksi berhasil diambil.'
        ], Response::HTTP_OK);
    }

    public function create(): JsonResponse
    {
        $transaksi = $this->transaksiService->createTransaction([
            'user_id' => Auth::id(),
            'kasir_name' => Auth::user()->name,
            'total' => 0,
        ]);

        return response()->json(['status' => 'success', 'data' => $transaksi, 'message' => 'Transaksi berhasil dibuat!'], Response::HTTP_CREATED);
    }

    public function edit(string $id, Request $request): JsonResponse
    {
        $produkId = $request->input('produk_id');
        $action = $request->input('action', 'plus');
        $qty = max(0, $request->input('qty', 0));
        $jumlahBayar = $request->input('jumlah_bayar', 0);

        $result = $produkId
            ? $this->transaksiService->addProductToTransaction($id, $produkId, $qty, $action)
            : null;

        return response()->json([
            'status' => 'success',
            'data' => [
                'transaksi' => $this->transaksiService->getTransactionById($id),
                'produk' => $this->transaksiService->getAllProducts(),
                'detail_produk' => $result['produk'] ?? null,
                'qty' => $result['qty'] ?? 0,
                'subtotal' => $result['subtotal'] ?? 0,
                'detail_transaksi' => $this->transaksiService->getTransactionDetail($id),
                'kembalian' => $this->transaksiService->calculateChange($id, $jumlahBayar),
            ],
            'message' => 'Detail transaksi berhasil diambil.'
        ], Response::HTTP_OK);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->transaksiService->deleteTransaction($id);
        return response()->json(['status' => 'success', 'message' => 'Transaksi berhasil dihapus!'], Response::HTTP_OK);
    }
    
    public function show(string $id): JsonResponse
    {
        $transaksi = $this->transaksiService->getTransactionById($id);
    
        if (!$transaksi) {
            return response()->json(['status' => 'error', 'message' => 'Transaksi tidak ditemukan.'], Response::HTTP_NOT_FOUND);
        }
    
        return response()->json([
            'status' => 'success',
            'data' => $transaksi,
            'message' => 'Detail transaksi berhasil diambil.'
        ], Response::HTTP_OK);
    }
}