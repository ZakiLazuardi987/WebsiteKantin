<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body ">
                    <h5><b>{{ $title }}</b></h5>
                    <hr>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                        <a href="/admin/produk/create" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah</a>
                        <form action="/admin/produk" method="GET" class="form-inline">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari Produk" value="{{ $search }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <table class="table mt-2">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($produk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="/{{ $item->gambar }}" width="70px" height="70px" alt=""></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->kategori->name }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>{{ $item->keterangan}}  </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/admin/produk/{{ $item->id }}/edit" class="btn btn-sm btn-info"><i
                                                class="fa fa-edit mr-1"></i>Edit</a>
                                        {{-- <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Hapus</a> --}}
                                        <form action="/admin/produk/{{ $item->id }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger ml-1"><i
                                                    class="fa fa-trash mr-1"></i>Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <div class="d-flex justify-content-right">
                        {{ $produk->appends(['search' => $search, 'perPage' => $perPage])->links() }}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
