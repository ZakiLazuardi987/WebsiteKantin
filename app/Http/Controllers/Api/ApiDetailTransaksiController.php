<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DetailTransaksiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiDetailTransaksiController extends Controller
{
    protected DetailTransaksiService $detailTransaksiService;

    public function __construct(DetailTransaksiService $detailTransaksiService)
    {
        $this->detailTransaksiService = $detailTransaksiService;
    }

    public function create(Request $request): JsonResponse
    {
        $data = [
            'produk_id' => $request->produk_id,
            'produk_name' => $request->produk_name,
            'transaksi_id' => $request->transaksi_id,
            'qty' => $request->qty,
            'subtotal' => $request->subtotal,
        ];

        $this->detailTransaksiService->createDetailTransaksi($data);

        return response()->json([
            'message' => 'Detail transaksi berhasil ditambahkan',
            'data' => $this->detailTransaksiService->getTransaksiById($request->transaksi_id),
        ], Response::HTTP_CREATED);
    }

    public function delete(Request $request): JsonResponse
    {   
        $id = $request->id;
        $this->detailTransaksiService->deleteDetailTransaksi($id);

        $transaksi = $this->detailTransaksiService->getTransaksiById($request->transaksi_id);
        $transaksi->update(['total' => $transaksi->total - $request->subtotal]);

        return response()->json([
            'message' => 'Detail transaksi berhasil dihapus',
            'data' => $transaksi,
        ], Response::HTTP_OK);
    }

    public function done($id): JsonResponse
    {
        $this->detailTransaksiService->finalizeTransaksi($id);
        return response()->json([
            'message' => 'Transaksi berhasil diselesaikan',
        ], Response::HTTP_OK);
    }
}
