<?php

namespace App\Http\Controllers;

use App\Services\DetailTransaksiService;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class AdminDetailTransaksiController extends Controller
{
    protected DetailTransaksiService $detailTransaksiService;

    public function __construct(DetailTransaksiService $detailTransaksiService)
    {
        $this->detailTransaksiService = $detailTransaksiService;
    }

    public function create(Request $request)
    {
        $data = [
            'produk_id' => $request->produk_id,
            'produk_name' => $request->produk_name,
            'transaksi_id' => $request->transaksi_id,
            'qty' => $request->qty,
            'subtotal' => $request->subtotal,
        ];

        $this->detailTransaksiService->createDetailTransaksi($data);

        $transaksi = $this->detailTransaksiService->getTransaksiById($request->transaksi_id);
        return redirect('/admin/transaksi/' . $transaksi->id . '/edit');
    }

    public function delete(Request $request)
    {   
        $id = $request->id;
        $this->detailTransaksiService->deleteDetailTransaksi($id);

        $transaksi = $this->detailTransaksiService->getTransaksiById($request->transaksi_id);
        $data = [
            'total' => $transaksi->total - $request->subtotal,
        ];
        $transaksi->update($data);

        return redirect()->back();
    }

    public function done($id)
    {
        $this->detailTransaksiService->finalizeTransaksi($id);
        Alert::success('Sukses', 'Transaksi berhasil ditambahkan!');
        return redirect('/admin/transaksi');
    }
}