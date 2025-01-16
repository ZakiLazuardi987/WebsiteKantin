    <div class="row pl-2 pt-2">

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Kode Produk</label>
                        </div>
                        <div class="col-md-8">
                            <form method="GET">
                                <div class="d-flex">
                                    <select name="produk_id" class="form-control" id="">
                                        <option value="">--
                                            {{ isset($detail_produk) ? $detail_produk->name : 'Pilih Produk' }} --
                                        </option>
                                        @foreach ($produk as $item)
                                            <option value="{{ $item->id }}">{{ $item->id . ' - ' . $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary ml-1">Pilih</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="/admin/transaksi/detail/create" method="POST">
                        @csrf

                        <input type="hidden" name='transaksi_id' value="{{ Request::segment(3) }}">
                        <input type="hidden" name='produk_id' value="{{ isset($detail_produk) ? $detail_produk->id : '' }}">
                        <input type="hidden" name='produk_name' value="{{ isset($detail_produk) ? $detail_produk->name : '' }}"> 
                        <input type="hidden" name='subtotal' value="{{ $subtotal }}">
                        
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Nama Produk</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ isset($detail_produk) ? $detail_produk->name : '' }}"
                                    class="form-control" disabled name="nama_produk" placeholder="Nama Produk">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Harga Satuan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ isset($detail_produk) ? $detail_produk->harga : '' }}"
                                    class="form-control" disabled name="harga_satuan" placeholder="Harga Satuan">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">QTY</label>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex">
                                    <a href="?produk_id={{ request('produk_id') }} & action=minus & qty={{ $qty }}"
                                        class="btn btn-primary"><i class="fas fa-minus"></i></a>
                                    <input type="number" value="{{ $qty }}" class="form-control ml-1 mr-1"
                                        name="qty" placeholder="QTY">
                                    <a href="?produk_id={{ request('produk_id') }} & action=plus & qty={{ $qty }}"
                                        class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-8">
                                <span class="text-primary">
                                    <h5>Subtotal : Rp. {{ format_rupiah($subtotal) }}</h5>
                                </span>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-8">
                                <a href="/admin/transaksi" class="btn btn-secondary"><i
                                        class="fas fa-arrow-left mr-2"></i>Kembali</a>
                                <button type="submit" class="btn btn-primary">Tambah<i
                                        class="fas fa-arrow-right ml-2"></i></button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table mt-2">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>QTY</th>
                            <th>Subtotal</th>
                            {{-- <th>#</th> --}}
                        </tr>

                        @foreach ($detail_transaksi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->produk_name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>Rp. {{ format_rupiah($item->subtotal) }}</td>
                                {{-- <td>
                                    <a href="/admin/transaksi/detail/delete?id={{ $item->id }}"><i class="fas fa-times"></i></a>
                                </td> --}}
                            </tr>
                        @endforeach  
                    </table>

                    <a href="/admin/transaksi/detail/done/{{ Request::segment(3) }}" class="btn btn-success"><i class="fas fa-check mr-2"></i>Selesai</a>
                    {{-- <a href="" class="btn btn-info"><i class="fas fa-file mr-2"></i>Pending</a> --}}
                </div>
            </div>
        </div>

    </div>

    <div class="row pl-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="">Total Belanja</label>
                            <input type="number" value="{{ $transaksi->total }}" name="total_belanja" class="form-control" id="">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Jumlah Bayar</label>
                            <input type="number" value="{{ request('jumlah_bayar') }}" name="jumlah_bayar" class="form-control" id="">
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block mr-2">Hitung</button>
                    </form>
                        <hr>
                        <div class="form-group">
                            <label for="">Uang Kembalian</label>
                            <input type="number" value="{{ format_rupiah($kembalian) }}" disabled name="kembalian" class="form-control" id="">
                        </div>
                    
                </div>
            </div>
        </div>
    </div>