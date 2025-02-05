<?php

// namespace App\Http\Controllers;

// use App\Services\DetailTransaksiService;
// use RealRashid\SweetAlert\Facades\Alert;
// use Illuminate\Http\Request;

// class AdminDetailTransaksiController extends Controller
// {
//     protected DetailTransaksiService $detailTransaksiService;

//     public function __construct(DetailTransaksiService $detailTransaksiService)
//     {
//         $this->detailTransaksiService = $detailTransaksiService;
//     }

//     public function create(Request $request)
//     {
//         $data = [
//             'produk_id' => $request->produk_id,
//             'produk_name' => $request->produk_name,
//             'transaksi_id' => $request->transaksi_id,
//             'qty' => $request->qty,
//             'subtotal' => $request->subtotal,
//         ];

//         $this->detailTransaksiService->createDetailTransaksi($data);

//         $transaksi = $this->detailTransaksiService->getTransaksiById($request->transaksi_id);
//         return redirect('/admin/transaksi/' . $transaksi->id . '/edit');
//     }

//     public function delete(Request $request)
//     {   
//         $id = $request->id;
//         $this->detailTransaksiService->deleteDetailTransaksi($id);

//         $transaksi = $this->detailTransaksiService->getTransaksiById($request->transaksi_id);
//         $data = [
//             'total' => $transaksi->total - $request->subtotal,
//         ];
//         $transaksi->update($data);

//         return redirect()->back();
//     }

//     public function done($id)
//     {
//         $this->detailTransaksiService->finalizeTransaksi($id);
//         Alert::success('Sukses', 'Transaksi berhasil ditambahkan!');
//         return redirect('/admin/transaksi');
//     }
// }


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DetailTransaksiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminDetailTransaksiController extends Controller
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
