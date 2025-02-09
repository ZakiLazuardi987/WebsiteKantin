<?php

namespace App\Http\Controllers;

use App\Services\TransaksiService;
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
            'detail_transaksi' => $this->transaksiService->getTransactionDetail($id),
            'kembalian' => $this->transaksiService->calculateChange($id, $jumlahBayar),
            'content' => 'admin/transaksi/create',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    public function destroy(string $id)
    {
        $this->transaksiService->deleteTransaction($id);
        Alert::success('Sukses', 'Data telah dihapus!');
        return redirect('/admin/transaksi');
    }
}
