<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body ">
                    <h5><b>{{ $title }}</b></h5>
                    <hr>

                    @isset($kategori)
                        <form id="editForm" action="/admin/produk/{{ $produk->id }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form id="editForm" action="/admin/produk" method="POST" enctype="multipart/form-data">
                    @endisset

                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" placeholder="Nama Produk" value="{{ isset($produk) ? $produk->name : ''}}">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="name">Kategori</label>
                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" {{ isset($produk) ? $produk->kategori_id == $item->id ? 'selected' : '' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>

                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="harga">Harga</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                name="harga" placeholder="Harga" value="{{ isset($produk) ? $produk->harga : ''}}">

                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="stok">Stok</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                name="stok" placeholder="Stok" value="{{ isset($produk) ? $produk->stok : ''}}">

                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                name="gambar" placeholder="Pilih Gambar">

                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            @isset($produk)
                                <img src="/{{ $produk->gambar }}" width="100px" alt="">
                                <br>
                            @endisset
                        </div>

                        <a href="/admin/produk" class="btn btn-secondary" ><i
                                class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        <button type="button" id="saveButton" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
