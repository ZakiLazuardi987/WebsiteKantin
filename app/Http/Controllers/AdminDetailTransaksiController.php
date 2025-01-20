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

// namespace App\Http\Controllers;

// use App\Models\DetailTransaksi;
// use App\Models\Transaksi;
// use Illuminate\Http\Request;

// class AdminDetailTransaksiController extends Controller
// {
//     function create(Request $request) {
//         $produk_id = $request->produk_id;
//         $transaksi_id = $request->transaksi_id;

//         $detail_transaksi = DetailTransaksi::whereProdukId($produk_id)->whereTransaksiId($transaksi_id)->first();

//         $transaksi = Transaksi::find($transaksi_id);
//         if($detail_transaksi == null) {
//             $data = [
//                 'produk_id' => $produk_id,
//                 'produk_name' => $request->produk_name,
//                 'transaksi_id' => $transaksi_id,
//                 'qty' => $request->qty,
//                 'subtotal' => $request->subtotal, 
//             ];
//             DetailTransaksi::create($data);

//             $total = [
//                 'total' => $request->subtotal + $transaksi->total
//             ];
//             $transaksi->update($total);
//         } else {
//             $data = [
//                 'qty' => $detail_transaksi->qty + $request->qty,
//                 'subtotal' => $detail_transaksi->subtotal + $request->subtotal,
//             ];
//             $detail_transaksi->update($data);

//             $total = [
//                 'total' => $request->subtotal + $transaksi->total
//             ];
//             $transaksi->update($total);
//         }
//         return redirect('/admin/transaksi/' . $transaksi_id. '/edit'); 
//     }

//     function delete() {
//         $id = request('id');
//         $detail_transaksi = DetailTransaksi::find($id);
//         $detail_transaksi->delete();

//         $transaksi = Transaksi::find($detail_transaksi->transaksi_id);
//         $data = [
//             'total' => $transaksi->total - $detail_transaksi->subtotal,
//         ];
//         $transaksi->update($data);

//         return redirect()->back();
//     }

//     function done($id) {
//         $transaksi = Transaksi::find($id);
//         $data = [
//             'status' => 'selesai'
//         ];
//         $transaksi->update($data);
//         return redirect('/admin/transaksi');
//     }
// }