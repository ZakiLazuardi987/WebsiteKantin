<?php

// namespace App\Http\Controllers;

// use App\Services\TransaksiService;
// use App\Models\Produk;
// use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;

// class AdminTransaksiController extends Controller
// {
//     protected TransaksiService $transaksiService;

//     public function __construct(TransaksiService $transaksiService)
//     {
//         $this->transaksiService = $transaksiService;
//     }

//     public function index()
//     {
//         $data = [
//             'title' => 'Kelola Transaksi',
//             'transaksi' => $this->transaksiService->getAllTransactions(5),
//             'content' => 'admin/transaksi/index',
//         ];
//         return view('admin.layouts.wrapper', $data);
//     }

//     public function create()
//     {
//         $transaksi = $this->transaksiService->createTransaction([
//             'user_id' => auth()->user()->id,
//             'kasir_name' => auth()->user()->name,
//             'total' => 0,
//         ]);

//         return redirect('admin/transaksi/' . $transaksi->id . '/edit');
//     }

//     public function edit(string $id, Request $request)
//     {
//         $produkId = $request->input('produk_id');
//         $action = $request->input('action', 'plus');
//         $qty = max(0, $request->input('qty', 0));
//         $jumlahBayar = $request->input('jumlah_bayar', 0);

//         // // Validasi produk ID
//         // if ($produkId && !$this->transaksiService->isValidProductId($produkId)) {
//         //     return redirect()->back()->with('error', 'Produk tidak valid!');
//         // }

//         // Tambahkan produk ke transaksi jika ada produk_id
//         $result = $produkId
//             ? $this->transaksiService->addProductToTransaction($id, $produkId, $qty, $action)
//             : null;

//         $data = [
//             'title' => 'Tambah Transaksi',
//             'produk' => $this->transaksiService->getAllProducts(),
//             'detail_produk' => $result['produk'] ?? null,
//             'qty' => $result['qty'] ?? 0,
//             'subtotal' => $result['subtotal'] ?? 0,
//             'transaksi' => $this->transaksiService->getTransactionById($id),
//             'detail_transaksi' => $this->transaksiService->getTransactionDetail($id),  // Mengirimkan detail transaksi
//             'kembalian' => $this->transaksiService->calculateChange($id, $jumlahBayar),
//             'content' => 'admin/transaksi/create',
//         ];

//         return view('admin.layouts.wrapper', data: $data);
//     }

//     public function destroy(string $id)
//     {
//         $this->transaksiService->deleteTransaction($id);
//         Alert::success('Sukses', 'Data telah dihapus!');
//         return redirect('/admin/transaksi');
//     }
// }


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TransaksiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminTransaksiController extends Controller
{
    protected TransaksiService $transaksiService;

    public function __construct(TransaksiService $transaksiService)
    {
        $this->transaksiService = $transaksiService;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Daftar Transaksi',
            'data' => $this->transaksiService->getAllTransactions(5),
        ], Response::HTTP_OK);
    }

    public function create(): JsonResponse
    {
        $transaksi = $this->transaksiService->createTransaction([
            'user_id' => Auth::id(),
            'kasir_name' => Auth::user()->name,
            'total' => 0,
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil dibuat',
            'data' => $transaksi,
        ], Response::HTTP_CREATED);
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
            'message' => 'Detail Transaksi',
            'transaksi' => $this->transaksiService->getTransactionById($id),
            'produk' => $this->transaksiService->getAllProducts(),
            'detail_produk' => $result['produk'] ?? null,
            'qty' => $result['qty'] ?? 0,
            'subtotal' => $result['subtotal'] ?? 0,
            'detail_transaksi' => $this->transaksiService->getTransactionDetail($id),
            'kembalian' => $this->transaksiService->calculateChange($id, $jumlahBayar),
        ], Response::HTTP_OK);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->transaksiService->deleteTransaction($id);

        return response()->json([
            'message' => 'Transaksi berhasil dihapus',
        ], Response::HTTP_OK);
    }
}
