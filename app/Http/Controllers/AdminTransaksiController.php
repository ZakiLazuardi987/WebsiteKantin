<?php

namespace App\Http\Controllers;

use App\Services\TransaksiService;
use App\Models\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminTransaksiController extends Controller
{
    protected TransaksiService $transaksiService;

    public function __construct(TransaksiService $transaksiService)
    {
        $this->transaksiService = $transaksiService;
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Transaksi',
            'transaksi' => $this->transaksiService->getAllTransactions(5),
            'content' => 'admin/transaksi/index',
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function create()
    {
        $transaksi = $this->transaksiService->createTransaction([
            'user_id' => auth()->user()->id,
            'kasir_name' => auth()->user()->name,
            'total' => 0,
        ]);

        return redirect('admin/transaksi/' . $transaksi->id . '/edit');
    }

    public function edit(string $id, Request $request)
    {
        $produkId = $request->input('produk_id');
        $action = $request->input('action', 'plus');
        $qty = max(0, $request->input('qty', 0));
        $jumlahBayar = $request->input('jumlah_bayar', 0);

        // // Validasi produk ID
        // if ($produkId && !$this->transaksiService->isValidProductId($produkId)) {
        //     return redirect()->back()->with('error', 'Produk tidak valid!');
        // }

        // Tambahkan produk ke transaksi jika ada produk_id
        $result = $produkId
            ? $this->transaksiService->addProductToTransaction($id, $produkId, $qty, $action)
            : null;

        $data = [
            'title' => 'Tambah Transaksi',
            'produk' => $this->transaksiService->getAllProducts(),
            'detail_produk' => $result['produk'] ?? null,
            'qty' => $result['qty'] ?? 0,
            'subtotal' => $result['subtotal'] ?? 0,
            'transaksi' => $this->transaksiService->getTransactionById($id),
            'detail_transaksi' => $this->transaksiService->getTransactionDetail($id),  // Mengirimkan detail transaksi
            'kembalian' => $this->transaksiService->calculateChange($id, $jumlahBayar),
            'content' => 'admin/transaksi/create',
        ];

        return view('admin.layouts.wrapper', data: $data);
    }

    public function destroy(string $id)
    {
        $this->transaksiService->deleteTransaction($id);
        Alert::success('Sukses', 'Data telah dihapus!');
        return redirect('/admin/transaksi');
    }
}

// namespace App\Http\Controllers;

// use App\Models\DetailTransaksi;
// use App\Models\Produk;
// use App\Models\Transaksi;
// use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;

// class AdminTransaksiController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         $data = [
//             'title' => 'Kelola Transaksi',
//             'transaksi' => Transaksi::orderBy('created_at', 'desc')->paginate(5),
//             'content' => 'admin/transaksi/index'
//         ];
//         return view('admin.layouts.wrapper', $data);
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         $data = [
//             'user_id' => auth()->user()->id,
//             'kasir_name' => auth()->user()->name,
//             'total' => 0,
//         ];
//         $transaksi = Transaksi::create($data);
//         return redirect('admin/transaksi/' . $transaksi->id . '/edit');
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         $produk = Produk::get();

//         $produk_id = request('produk_id');
//         $detail_produk = Produk::find($produk_id);

//         $detail_transaksi = DetailTransaksi::whereTransaksiId($id)->get();

//         $action = request('action');
//         $qty = request('qty');
//         if ($action == 'minus') {
//             if ($qty <= 1) {
//                 $qty = 1;
//             } else {
//                 $qty = $qty - 1;
//             }
//         } else {
//             $qty = $qty + 1;
//         }

//         $subtotal = 0;
//         if ($detail_produk) {
//             $subtotal = $qty * $detail_produk->harga;
//         }

//         $transaksi = Transaksi::find($id);

//         $jumlah_bayar = request('jumlah_bayar');
//         $kembalian = $jumlah_bayar - $transaksi->total;

//         $data = [
//             'title' => 'Tambah Transaksi',
//             'produk' => $produk,
//             'detail_produk' => $detail_produk,
//             'qty' => $qty,
//             'subtotal' => $subtotal,
//             'detail_transaksi' => $detail_transaksi,
//             'transaksi' => $transaksi,
//             'kembalian' => $kembalian,
//             'content' => 'admin/transaksi/create'
//         ];
//         return view('admin.layouts.wrapper', $data);
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         // Mencari transaksi berdasarkan ID
//         $transaksi = Transaksi::find($id);

//         if ($transaksi) {
//             // Menghapus transaksi jika ditemukan
//             $transaksi->delete();
//             Alert::success('Sukses', 'Data telah dihapus!');
//         } else {
//             Alert::error('Gagal', 'Data tidak ditemukan!');
//         }

//         return redirect('/admin/transaksi');
//     }
// }
